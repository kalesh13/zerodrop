<?php

namespace App\Contracts;

interface PageContract
{
    /**
     * Creates and saves the page on the database, if it does not already exists.
     * No changes are made if it does exists.
     * 
     * @param array $data
     * @return \App\Models\Page
     */
    public function create(array $data = []);

    /**
     * Updates the page details on the database if it exists.
     * 
     * @param array $data
     * @return \App\Models\Page|null
     */
    public function update(array $data);

    /**
     * Returns all the properties of the page. This is the latest data from the 
     * database and could differ from the default properties defined in the 
     * individual pages.
     * 
     * @return array
     */
    public function properties();
}
