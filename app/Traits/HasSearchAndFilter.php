<?php

namespace App\Traits;

trait HasSearchAndFilter
{
    /**
     * The column associated to search queries.
     * 
     * @var string
     */
    protected $search_column = 'id';

    /**
     * The column associated to filter queries.
     * 
     * @var string
     */
    protected $filter_column = 'active';

    /**
     * Sets a where query on the the given query to perform filter requests.
     * 
     * If no filter column is set, 'active' column is checked for the filter keyword.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Collection $request
     */
    protected function setFilterOnQuery($query, $request)
    {
        if ($request->has('filter')) {
            $query->where($this->filterColumn(), $request->get('filter'));
        }
    }

    /**
     * Sets a where query on the the given query to perform search requests.
     * 
     * If no search column is set, 'id' column is checked for the search keywords.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Collection $request
     */
    protected function setSearchOnQuery($query, $request)
    {
        if ($request->has('search')) {
            $query->where($this->searchColumn(), 'like', '%' . $request->get('search') . '%');
        }
    }

    /**
     * Sets a where query on the the given query for the given `$column`. For example,
     * to perform a `$query->where('id', $request->id)` use this function with the third 
     * argument as `id`
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Collection $request
     * @param string $column
     */
    protected function setWhereOnQuery($query, $request, $column)
    {
        if ($column && $request->has($column)) {
            $query->where($column, $request->get($column));
        }
    }

    /**
     * Associates a new column for the filter queries.
     * 
     * @param string $column
     * @return static
     */
    protected function setFilterColumn($column)
    {
        $this->filter_column = $column;

        return $this;
    }

    /**
     * Returns the column that is associated to filter checks.
     * 
     * @return string
     */
    protected function filterColumn()
    {
        return $this->filter_column;
    }

    /**
     * Associates a new column for the search queries.
     * 
     * @param string $column
     * @return static
     */
    protected function setSearchColumn($column)
    {
        $this->search_column = $column;

        return $this;
    }

    /**
     * Returns the column that is associated to search checks.
     * 
     * @return string
     */
    protected function searchColumn()
    {
        return $this->search_column;
    }
}
