<?php

namespace App\Services\Pages;

use Illuminate\Contracts\Support\Renderable;

class AboutPage extends PageBase implements Renderable
{
    /**
     * Name of the page in the database.
     * 
     * @var string
     */
    protected $page_name = 'about';

    /**
     * Returns the view to render when this page is loaded.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('about_page', ['data' => $this->properties()]);
    }

    /**
     * Returns the default properties of this page.
     * 
     * @return array
     */
    protected function defaultProperties()
    {
        return [
            'description' => 'The promoter of the institute was started his carrier with USA based drilling equipment manufacturer in 1982, one of the world best BOP, X-Mass Tree(An assembly of Valves) manufactures and retired from WEIR GROUP, one of the world best valves and pump manufactures. Total 35 years he has served with valve manufacturer, EPC companies, LNG Process Industries and finally retired as After Market Sales Manager from the Weir Group in July, 2017. A valve and actuator training program tailored to the educational needs of the next generation—or anyone who needs a primer on the valve industry.',
            'show_team' => '0',
            'team_member_1' => '',
            'team_member_2' => '',
            'team_member_3' => '',
            'team_member_4' => '',
            'meta_title' => 'About | Zerodrop',
            'meta_description' => 'We believe that with the right education and training, any competent industry professional can become proficient in dealing with a whole range of up-stream and down-stream valve and control system issues – even in the world’s most hostile working environments.',
            'meta_keywords' => 'about zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design',
        ];
    }
}
