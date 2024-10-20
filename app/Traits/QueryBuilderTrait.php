<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

trait QueryBuilderTrait
{
    protected mixed $modelClass;

    protected function getQuery(Request $request): QueryBuilder
    {
        $query = QueryBuilder::for($this->modelClass);

        return $this->defaultQuery($query, $request);
    }

    protected function defaultQuery(QueryBuilder $query, Request $request): QueryBuilder
    {
        $query = $this->defaultAllowFilter($query, $request);
        $query->allowedIncludes(! empty($request->include) ? explode(',', $request->get('include')) : []);
        $query->allowedSorts($request->get('sort'));

        return $query;
    }

    protected function defaultAllowFilter(QueryBuilder $query, Request $request): QueryBuilder
    {
        $filters = $request->get('filter');
        $filter = [];
        if (! empty($filters)) {
            foreach ($filters as $k => $item) {
                $filter[] = AllowedFilter::exact($k);
            }
        }
        $query->allowedFilters($filter);

        return $query;
    }
}
