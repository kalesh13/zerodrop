<?php

namespace App\Model\Traits;

use Illuminate\Support\Arr;

/**
 * Magic methods and properties
 * 
 * @method static bool insertOrUpdateOnDuplicate(array $rows, array $exclude = [])
 */
trait InsertOrUpdateOnDuplicate
{
    /**
     * Inserts the given rows or updates the row when a duplicate key is already
     * present in the table.
     *
     * @param array $rows
     * @param array $exclude The attributes to exclude in case of update.
     */
    private function insertOrUpdateOnDuplicate(array $rows, array $exclude = [])
    {
        // We assume all rows have the same keys so we arbitrarily pick one of them.
        $columns = array_keys($rows[0]);

        $columns_string = implode('`,`', $columns);
        $values = $this->buildSQLValuesFrom($rows);
        $updates = $this->buildSQLUpdatesFrom($columns, $exclude);
        $params = Arr::flatten($rows, 1);

        $table = $this->getTable();
        $query = "insert into {$table} (`{$columns_string}`) values {$values} on duplicate key update {$updates}";

        return $this->getConnection()->insert($query, $params);
    }

    /**
     * Build proper SQL string for the values.
     *
     * @param array $rows
     * @return string
     */
    private function buildSQLValuesFrom(array $rows)
    {
        $values = collect($rows)->reduce(function ($values_string, $row) {
            return $values_string .= '(' . rtrim(str_repeat('?,', count($row)), ',') . '),';
        }, '');

        return rtrim($values, ',');
    }

    /**
     * Build proper SQL string for the on duplicate update scenario.
     *
     * @param       $columns
     * @param array $exclude
     * @return string
     */
    private function buildSQLUpdatesFrom($columns, array $exclude)
    {
        $update_string = collect($columns)->reject(function ($column) use ($exclude) {
            return in_array($column, $exclude);
        })->reduce(function ($updates, $column) {
            return $updates .= "`{$column}`=VALUES(`{$column}`),";
        }, '');

        return trim($update_string, ',');
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
