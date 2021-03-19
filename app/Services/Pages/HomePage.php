<?php

namespace App\Services\Pages;

use Illuminate\Contracts\Support\Renderable;

class HomePage extends PageBase implements Renderable
{
    /**
     * Name of the page in the database.
     * 
     * @var string
     */
    protected $page_name = 'home';

    /**
     * Returns the view to render when this page is loaded.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('home_page', ['data' => $this->properties()]);
    }

    /**
     * Returns the default properties of this page.
     * 
     * @return array
     */
    protected function defaultProperties()
    {
        return [
            "feature_image" => "/images/feature_image_2.jpg",
            "carousal_text" => "Lorem Ipsum Dolor sumit",
            "feature_course" => "",
            "course_description" => "Still have some query? Ring us on the number provided or use the form given below.",
            "contact_description" => "Still have some query? Ring us on the number provided or use the form given below.",
            "contact_phone" => "+91-0476123456",
            "meta_title" => "Zerodrop Technical Training Center",
            "meta_description" => "The increasing demand for Valve expertise in the industries and lack of persons with the right knowledge and skills forced us to create an educational program that helps you to stand ahead of others in the market. The Valve Engineer Certification program is tailored to meet the educational needs of the next generation - or anyone who needs a primer on the Valve Industry.",
            "meta_keywords" => "zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design"
        ];
    }
}
