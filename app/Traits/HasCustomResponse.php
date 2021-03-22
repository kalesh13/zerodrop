<?php

namespace App\Traits;

use App\Model\Contracts\PropertyModelContract;

trait HasCustomResponse
{
    /**
     * Makes only the property key attributes visible when serialized. 
     * 
     * If an argument is provided, they will also be visible when serialized.
     * 
     * @param array $additional_columns
     * 
     * @return $this
     */
    public function getPropertiesOnly(array $additional_columns = [])
    {
        $columns_to_keep = [];

        if ($this instanceof PropertyModelContract) {
            $columns_to_keep = array_keys($this->properties());
        }
        $columns_to_keep = array_merge($columns_to_keep, is_array($additional_columns) ? $additional_columns : []);

        return $this->setVisible($columns_to_keep);
    }

    /**
     * Makes only the summary columns visible when serialized. 
     * 
     * If an argument is provided, they will also be visible when serialized.
     * 
     * @param array $additional_columns
     * 
     * @return $this
     */
    public function getSummary(array $additional_columns = [])
    {
        $columns_to_keep = $this->columnsToShowInSummary();

        $columns_to_keep = array_merge($columns_to_keep, is_array($additional_columns) ? $additional_columns : []);

        return $this->setVisible($columns_to_keep);
    }

    /**
     * Returns the attribute/column names to show in the summary list.
     * 
     * @return array
     */
    public function columnsToShowInSummary()
    {
        return [];
    }
}
