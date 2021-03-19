<?php

namespace App\Services\Pages;

interface IPageFactory
{
    /**
     * Renders the given page if it is renderable, otherwise returns a 404 Page not
     * found exception.
     * 
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function show($page);

    /**
     * Returns all the properties of the given page.
     * 
     * @param string $page
     * @return array
     */
    public function propertiesOfPage($page);

    /**
     * Updates a page with the passed data.
     * 
     * @param string $page
     * @param array $data
     */
    public function updatePage($page, array $data);

    /**
     * Creates and saves all the pages on the database if they does not already
     * exists.
     * 
     * New page can be just added to the `$page` array and calling route `/admin/page/seed` 
     * will update the database.
     */
    public function seed();

    /**
     * Returns true if the `$page` is defined in the `$pages` list.
     * 
     * @param string $page
     * @return bool
     */
    public function hasPage($page);
}