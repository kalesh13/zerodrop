<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Pages\IPageFactory;

class PageController extends Controller
{
    /**
     * Application page factory.
     * 
     * @var \App\Services\Pages\IPageFactory
     */
    protected $page_factory;

    /**
     * Creates a new controller that takes care of all page related tasks.
     * 
     * @param \App\Services\Pages\IPageFactory $page_factory
     */
    public function __construct(IPageFactory $page_factory)
    {
        $this->page_factory = $page_factory;
    }

    /**
     * Renders the home page if it exists on the page factory or throws a not found 
     * exception.
     * 
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return $this->show('home');
    }

    /**
     * Renders the about page if it exists on the page factory or throws a not found 
     * exception.
     * 
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return $this->show('about');
    }

    /**
     * Renders the contact page if it exists on the page factory or throws a not found 
     * exception.
     * 
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return $this->show('contact');
    }

    /**
     * Renders the given page if it exists or throws a not found exception.
     * 
     * @param string $page
     * @return \Illuminate\View\View
     */
    protected function show($page)
    {
        return $this->page_factory->show($page);
    }

    /**
     * Returns all the properties of the page saved in the database.
     * 
     * @param string $page
     * @return array
     */
    public function retreive($page)
    {
        return $this->page_factory->propertiesOfPage($page);
    }

    /**
     * Updates a page with the data present in the request.
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $page
     * @return \App\Models\Page
     */
    public function update(Request $request, $page)
    {
        if ($this->page_factory->hasPage($page)) {
            return $this->page_factory->updatePage($page, $request->all());
        }
        return response()->json(['page', 'Error updating data'], '404');
    }

    /**
     * Creates and saves all the pages on the database if they does not already
     * exists.
     * 
     * Controller action for the endpoint `/admin/page/seed`
     */
    public function seed()
    {
        return $this->page_factory->seed();
    }
}
