<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\ISettings;

class ViewSettings
{
    /**
     * Web application settings.
     * 
     * @var \App\Contracts\ISettings
     */
    protected $settings;

    /**
     * This middleware is responsible for loading and sharing the settings with all the 
     * application views.
     * 
     * @param \App\Contracts\ISettings $settings
     */
    public function __construct(ISettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->settings->shareSettings();

        return $next($request);
    }
}
