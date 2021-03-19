<?php

namespace App\Services\Pages;

use App\Models\Page;
use Illuminate\Support\Str;
use App\Contracts\PageContract;

abstract class PageBase implements PageContract
{
    /**
     * The page model for the given page name.
     * 
     * @var \App\Models\Page
     */
    protected $page;

    /**
     * Name of the page in the database.
     * 
     * @var string
     */
    protected $page_name = '';

    /**
     * Returns all the default properties of this page as an associative array with 
     * property name as key.
     * 
     * @return array
     */
    protected abstract function defaultProperties();

    /**
     * Creates a new page service for the given page name.
     * 
     * We will load the model for the name when we construct this service.
     */
    public function __construct()
    {
        $this->setModel($this->getModel());

        $this->setPagePropertiesOnModel($this->defaultProperties());
    }

    /**
     * Returns the page model for the given page name.
     * 
     * @return \App\Models\Page|null
     */
    public function getModel()
    {
        if ($this->page) {
            return $this->page;
        }
        return Page::where('name', $this->page_name)->first();
    }

    /**
     * Sets the given page model on this service.
     * 
     * @param \App\Models\Page $page
     */
    public function setModel($page)
    {
        $this->page = $page;
    }

    /**
     * Sets the given properties on the page.
     * 
     * @param array $properties
     */
    public function setPagePropertiesOnModel(array $properties)
    {
        if ($model = $this->getModel()) {
            $model->setPageProperties($properties);
        }
    }

    /**
     * Creates and saves the page on the database, if it does not already exists.
     * No changes are made if it does exists.
     * 
     * @param array $data
     * @return \App\Models\Page
     */
    public function create(array $data = [])
    {
        if ($model = $this->getModel()) {
            return $model;
        }
        $this->page = static::newPageFrom($this->page_name);
        $this->page->setPageProperties($this->defaultProperties());

        $this->page->save();

        return $this->update(array_merge($this->defaultProperties(), $data));
    }

    /**
     * Updates the page details on the database if it exists.
     * 
     * @param array $data
     * @return \App\Models\Page|null
     */
    public function update(array $data)
    {
        if ($model = $this->getModel()) {
            $model->saveProperties($data);

            return $model;
        }
    }

    /**
     * Returns all the properties of the page. This is the latest data from the 
     * database and could differ from the default properties defined in the 
     * individual pages.
     * 
     * @return array
     */
    public function properties()
    {
        if ($model = $this->getModel()) {
            return $model->toArray();
        }
        return [];
    }

    /**
     * Returns a new page model populated with the name and slug field using the
     * given name and slug value. If no slug field is given, then a slug of the name
     * field is used. 
     * 
     * @param string $name
     * @param string $slug
     * @return \App\Models\Page
     */
    public static function newPageFrom($name, $slug = null)
    {
        $page = new Page();
        $page->name = $name;
        $page->slug = $slug ?? Str::slug($name);

        return $page;
    }

    /**
     * Gets a property from the page model.
     * 
     * @param string $key
     */
    public function __get($key)
    {
        if ($model = $this->getModel()) {
            return $model->{$key};
        }
    }
}
