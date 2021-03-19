<?php

namespace App\Services\Pages;

use Illuminate\Contracts\Support\Renderable;

class ContactPage extends PageBase implements Renderable
{
    /**
     * Name of the page in the database.
     * 
     * @var string
     */
    protected $page_name = 'contact';

    /**
     * Returns the view to render when this page is loaded.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('contact_page', ['data' => $this->properties()]);
    }

    /**
     * Returns the default properties of this page.
     * 
     * @return array
     */
    protected function defaultProperties()
    {
        return [
            'description' => 'ZeroDrop started its operation on August, 2018 and the main office is located at Nettur Junction in Eranakulam District. Please use the form given below for any enquiry, or you could visit us at our office during office hours.',
            'map' => '<iframe width="100%" height="500" id="gmap_canvas" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=whiteline%20international%20aroor&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>',
            'meta_title' => 'Contact | Zerodrop',
            'meta_description' => 'Have something to ask us? Send us an email and our customer service executive will get back to you ASAP.',
            'meta_keywords' => 'contact zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design',
            'meta_robots' => 'index, follow'
        ];
    }
}
