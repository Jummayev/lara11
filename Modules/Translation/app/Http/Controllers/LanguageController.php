<?php

namespace Modules\Translation\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Translation\app\Http\Requests\Language\StoreRequest;
use Modules\Translation\app\Http\Requests\Language\UpdateRequest;
use Modules\Translation\app\Models\Language;

class LanguageController extends Controller
{
    protected mixed $modelClass = Language::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->getQuery($request);
        $data = $query->get();

        return response()->json($data);
    }

    public function client(Request $request)
    {
        $query = $this->getQuery($request);
        $query->where('status', Language::STATUS_ACTIVE);
        $data = $query->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $model = $this->modelClass::create($data);
        $this->updateDefault($model);

        return response()->json($model);
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $query = $this->getQuery($request);
        $model = $query->firstOrFail($id);

        return response()->json($model);
    }

    public function clientShow(Request $request, int $id)
    {
        $query = $this->getQuery($request);
        $query->where('status', Language::STATUS_ACTIVE);
        $model = $query->firstOrFail($id);

        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Language $language)
    {
        $data = $request->validated();
        $language->update($data);
        $this->updateDefault($language);

        return response()->json($language);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Language $language)
    {
        $language->delete();

        return response()->json($language);
    }

    public function updateDefault(Language $model)
    {
        if ($model->is_default) {
            $this->modelClass::query()
                ->where('id', '!=', $model->id)
                ->update(['is_default' => false]);
        }
    }
}
