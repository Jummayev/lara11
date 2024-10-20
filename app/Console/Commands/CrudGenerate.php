<?php

namespace App\Console\Commands;

use Brick\VarExporter\VarExporter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use stdClass;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\text;

class CrudGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
        {model? : The name of the class}
        {path? : The path of the class}
        {table? : The table name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD';

    private ?string $model;

    private ?string $path;

    private ?string $table;

    private array $columns = [];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->model = $this->argument('model');
        if (empty($this->model)) {
            $this->model = text('What is the name of the class?', required: true, default: 'Post');
        }
        $this->model = ucfirst($this->model);
        $this->path = $this->argument('path');
        if (empty($this->path)) {
            $this->path = text('What is the path of the class?', default: 'Api/V1', required: true);
        }

        $this->table = $this->argument('table');
        if (empty($this->table)) {
            $this->table = Str::snake(Str::pluralStudly(class_basename($this->model)));
            $this->table = text('What is the path of the class?', default: $this->table, required: true);
        }

        $class = multiselect(
            label: 'What should be created?',
            options: [
                'Model' => 'Model',
                'Controller' => 'Controller',
                'Route' => 'Route',
                'Request' => 'Request',
                'Policies' => 'Policies',
            ],
            default: ['Model', 'Controller', 'Route', 'Request']
        );
        $this->getColumnsDefinitionsFromTable();

        if (in_array('Model', $class)) {
            $this->createModel();
            $this->info('Model created successfully.');
        }
        if (in_array('Controller', $class)) {
            $this->createController();
            $this->info('Controller created successfully.');
        }
        if (in_array('Route', $class)) {
            $this->createRoute();
            $this->info('Route created successfully.');
        }
        if (in_array('Request', $class)) {
            $this->createRequest();
            $this->info('Request created successfully.');
        }
        if (in_array('Policies', $class)) {
            exec("php artisan make:policy {$this->model}Policy --model={$this->model} --force");
            $this->info('Policies created successfully.');
        }

        exec('./vendor/bin/pint');
        Artisan::call('optimize:clear');
        Artisan::call('optimize');

        $this->info('All done!');
    }

    private function createModel()
    {
        $stub = $this->getStub('Model');
        $createStub = str_replace('{{modelName}}', $this->model, $stub);
        $createStub = str_replace('{{table}}', $this->table, $createStub);

        $columns = $this->columns;
        $fillable = [];
        foreach ($columns as $key => $column) {
            if (in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }
            $fillable[] = "'$key'";
        }
        $createStub = str_replace('{{fillable}}', implode(",\n\t\t", $fillable), $createStub);

        $path = app_path('Models');
        file_put_contents("$path/{$this->model}.php", $createStub);
    }

    private function createRequest()
    {
        $path = app_path("Http/Requests/{$this->model}");
        if (! File::exists($path)) {
            File::makeDirectory($path, recursive: true);
        }
        $columns = $this->columns;
        $rules = [];
        foreach ($columns as $key => $column) {
            if (in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }
            $rule = $this->generateColumnRules($column);
            $rules[$key] = $rule;
        }
        $rules = VarExporter::export($rules, VarExporter::INLINE_SCALAR_LIST);
        $rules = str_replace("\n", "\n        ", $rules);
        $updateRules = str_replace('required', 'nullable', $rules);

        $stub = $this->getStub('StoreRequest');
        $createStub = str_replace('{{modelName}}', $this->model, $stub);
        $createStub = str_replace('{{rules}}', $rules, $createStub);
        file_put_contents($path."/Store{$this->model}Request.php", $createStub);

        $stub = $this->getStub('UpdateRequest');
        $updateStub = str_replace('{{modelName}}', $this->model, $stub);
        $updateStub = str_replace('{{rules}}', $updateRules, $updateStub);
        file_put_contents($path."/Update{$this->model}Request.php", $updateStub);
    }

    protected function getStub(string $name): string
    {
        return file_get_contents(base_path("stubs/$name.stub"));
    }

    public static array $integerTypes = [
        'smallint' => ['-32768', '32767'],
        'integer' => ['-2147483648', '2147483647'],
        'bigint' => ['-9223372036854775808', '9223372036854775807'],
    ];

    protected function getColumnsDefinitionsFromTable()
    {
        $databaseName = env('DB_DATABASE');
        $tableName = $this->table;

        $tableColumns = collect(DB::select(
            '
            SELECT *
                FROM INFORMATION_SCHEMA.COLUMNS
            WHERE table_name = :table ORDER BY ordinal_position',
            ['table' => $tableName]
        ))->keyBy('column_name')->toArray();

        $uniques = collect(DB::select(
            "
                SELECT conname, pg_get_constraintdef(oid)
                FROM pg_constraint
                WHERE conrelid = '$tableName'::regclass AND contype = 'u'",
        ))->toArray();

        foreach ($uniques as $unique) {
            preg_match("/\(([^)]+)\)/", $unique->pg_get_constraintdef, $matches);
            $column = @$matches[1];
            if (! empty($column)) {
                $tableColumns[$column]->unique = true;
            }
        }

        $foreignKeys = DB::select("
            SELECT
                kcu.column_name,
                ccu.table_name AS foreign_table_name,
                ccu.column_name AS foreign_column_name
            FROM
                information_schema.table_constraints AS tc
                JOIN information_schema.key_column_usage AS kcu
                  ON tc.constraint_name = kcu.constraint_name
                  AND tc.table_schema = kcu.table_schema
                JOIN information_schema.constraint_column_usage AS ccu
                  ON ccu.constraint_name = tc.constraint_name
                  AND ccu.table_schema = tc.table_schema
            WHERE tc.constraint_type = 'FOREIGN KEY' AND tc.table_name=? AND tc.table_catalog=?
        ", [$tableName, $databaseName]);

        foreach ($foreignKeys as $foreignKey) {
            $tableColumns[$foreignKey->column_name]->Foreign = [
                'table' => $foreignKey->foreign_table_name,
                'id' => $foreignKey->foreign_column_name,
            ];
        }

        $this->columns = $tableColumns;
    }

    protected function generateColumnRules(stdClass $column): array
    {
        $columnRules = [];
        $columnRules[] = $column->is_nullable === 'YES' ? 'nullable' : 'required';

        if (! empty($column->Foreign)) {
            $columnRules[] = 'exists:'.implode(',', $column->Foreign);

            return $columnRules;
        }
        if (! empty($column->unique)) {
            $columnRules[] = 'unique:'.$column->table_name.','.$column->column_name;

            return $columnRules;
        }

        $type = Str::of($column->data_type);
        switch (true) {
            case $type == 'boolean':
                $columnRules[] = 'boolean';

                break;
            case $type->contains('char'):
                $columnRules[] = 'string';
                $columnRules[] = 'min:0';
                $columnRules[] = 'max:'.$column->character_maximum_length;

                break;
            case $type == 'text':
                $columnRules[] = 'string';
                $columnRules[] = 'min:0';

                break;
            case $type->contains('int'):
                $columnRules[] = 'integer';
                $columnRules[] = 'min:'.(self::$integerTypes[$type->__toString()][0] ?: 0);
                $columnRules[] = 'max:'.self::$integerTypes[$type->__toString()][1];

                break;
            case $type->contains('double') ||
            $type->contains('decimal') ||
            $type->contains('numeric') ||
            $type->contains('real'):
                // should we do more specific here?
                // some kind of regex validation for double, double unsigned, double(8, 2), decimal etc...?
                $columnRules[] = 'numeric';

                break;
                // unfortunately, it's not so easy in pgsql to find out if a column is an enum
                //            case $type->contains('enum') || $type->contains('set'):
                //                preg_match_all("/'([^']*)'/", $type, $matches);
                //                $columnRules[] = "in:".implode(',', $matches[1]);
                //
                //                break;
            case $type == 'date' || $type->contains('time '):
                $columnRules[] = 'date';

                break;
            case $type->contains('json'):
                $columnRules[] = 'json';

                break;
            default:
                // I think we skip BINARY and BLOB for now
                break;
        }

        return $columnRules;
    }

    private function createController()
    {
        $stub = $this->getStub('Controller');
        $createStub = str_replace('{{modelName}}', $this->model, $stub);
        $smaleModel = Str::lower($this->model);
        $createStub = str_replace('{{smaleModel}}', $smaleModel, $createStub);

        if (! empty($this->path)) {
            $createStub = str_replace('{{path}}', '\\'.str_replace('/', '\\', $this->path), $createStub);
        }
        $path = app_path("Http/Controllers/{$this->path}");
        if (! File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        file_put_contents("$path/{$this->model}Controller.php", $createStub);
    }

    private function createRoute()
    {
        $model = $this->model;
        $smaleModel = Str::lower($model);
        $table = Str::snake(Str::pluralStudly(class_basename($this->model)));

        $route = <<<TEXT
/** Start $model Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/$table')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'show'])->whereNumber('id');
        Route::put('{{$smaleModel}}', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'update'])->whereNumber('$smaleModel');
        Route::delete('{{$smaleModel}}', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'destroy'])->whereNumber('$smaleModel');
    });
    Route::prefix('$table')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\\{$model}Controller::class, 'clientShow'])->whereNumber('id');
    });
});
/** End $model Routes */
TEXT;
        \Illuminate\Support\Facades\File::append(base_path('routes/api.php'), $route);
    }
}
