<?php

namespace Database\Seeders;

use App\Services\Pages\IPageFactory;

class PageSeeder
{
    /**
     * Application page factory.
     * 
     * @var \App\Services\Pages\IPageFactory
     */
    protected $page_factory;

    /**
     * Creates a new seeder that takes care of all the app pages.
     * 
     * @param \App\Services\Pages\IPageFactory $page_factory
     */
    public function __construct(IPageFactory $page_factory)
    {
        $this->page_factory = $page_factory;
    }

    /**
     * Saves all the application pages and their meta data on the database.
     *
     * @return void
     */
    public function run()
    {
        $this->page_factory->seed();
    }
}
