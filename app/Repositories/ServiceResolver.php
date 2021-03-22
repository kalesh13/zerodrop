<?php

namespace App\Repositories;

use Closure;
use App\Repositories\IServiceResolver;

class ServiceResolver implements IServiceResolver
{
    /**
     * Anonymous function that returns a new service object.
     * 
     * @var \Closure
     */
    protected $service_resolver;

    /**
     * Creates a API client service factory. The parameter `$service_resolver` should be an 
     * anonymous function that returns the service object.
     * 
     * @param \Closure $service_resolver
     */
    public function __construct(Closure $service_resolver)
    {
        $this->service_resolver = $service_resolver;
    }

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function resolveService($model)
    {
        return call_user_func($this->service_resolver, $model);
    }
}
