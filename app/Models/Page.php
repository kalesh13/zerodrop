<?php

namespace App\Models;

use App\Model\Traits\HasPropertyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use HasPropertyModel;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['pageData'];

    /**
     * The page properties and their default values. 
     * 
     * Each page have different properties, so we can't have a default set of properties 
     * in here. To set the properties for individual pages we expose a setter function.
     * 
     * @var array
     */
    private $page_properties = [];

    /**
     * Sets the properties of this page.
     * 
     * @param array $properties
     */
    public function setPageProperties(array $properties)
    {
        $this->page_properties = $properties;
    }

    /**
     * Returns all the properties of this page.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageData()
    {
        return $this->hasMany(PageData::class);
    }

    /**
     * Return the properties and their default values of this page.
     * 
     * @return array
     */
    public function properties()
    {
        return $this->page_properties;
    }
}
