<?php

namespace App\Services\Pages;

use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageFactory implements IPageFactory
{
    /**
     * Cache of all the application pages.
     * 
     * @var array
     */
    protected $pages = [
        'home' => \App\Services\Pages\HomePage::class,
        'about' => \App\Services\Pages\AboutPage::class,
        'contact' => \App\Services\Pages\ContactPage::class,
        'settings' => \App\Services\Pages\Settings::class,
    ];

    /**
     * Renders the given page if it is renderable, otherwise returns a 404 Page not
     * found exception.
     * 
     * @param string $page
     * @return \Illuminate\View\View
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function show($page)
    {
        if ($this->hasPage($page)) {
            $page = new $this->pages[$page];

            if ($page instanceof Renderable) {
                return $page->render();
            }
        }
        throw new NotFoundHttpException();
    }

    /**
     * Returns all the properties of the given page.
     * 
     * @param string $page
     * @return array
     */
    public function propertiesOfPage($page)
    {
        if ($this->hasPage($page)) {
            return (new $this->pages[$page])->properties();
        }
        return [];
    }

    /**
     * Updates a page with the passed data.
     * 
     * @param string $page
     * @param array $data
     */
    public function updatePage($page, array $data)
    {
        if ($this->hasPage($page)) {
            return (new $this->pages[$page])->update($data);
        }
    }

    /**
     * Returns true if the `$page` is defined in the `$pages` list.
     * 
     * @param string $page
     * @return bool
     */
    public function hasPage($page)
    {
        return array_key_exists($page, $this->pages);
    }

    /**
     * Creates and saves all the pages on the database if they does not already
     * exists.
     * 
     * New page can be just added to the `$page` array and calling route `/admin/page/seed` 
     * will update the database.
     */
    public function seed()
    {
        collect($this->pages)->each(function ($class) {
            (new $class)->create();
        });
    }
}
