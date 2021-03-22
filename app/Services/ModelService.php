<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

abstract class ModelService implements IModelService
{
    /**
     * The model on which this service operates.
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Creates a new service that operates on the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Returns the underlying model of the ModelService.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Returns the alias that can be used to get the model used by this service.
     * 
     * For example, this function will return `category` for the `CategoryService` class.
     * The magic methods defined will ensure that calling function or properties using this
     * alias returns the model itself.
     * 
     * @return string
     */
    protected function modelName()
    {
        return Str::snake(
            Str::replaceLast('Service', '', class_basename(static::class))
        );
    }

    /**
     * Returns the model if the property name matches the model name.
     * 
     * @param string $name Requested property name.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function __get($name)
    {
        if ($this->modelName() === $name) {
            return $this->model;
        }
        return $this->model->{$name};
    }

    /**
     * Returns the model, if the method name matches the model name. 
     * 
     * If it doesn't we will try to fetch a property from the underlying model. The underlying 
     * property should be in snake_case. That is the standard we used throughout while designing 
     * database models.
     * 
     * For example, to fetch first_name field from user service, we can call $userService->firstName()
     * Calling the above function will fetch the first_name field from the underlying user if no
     * firstName() exists in the service.
     * 
     * This allows us to avoid unnecessary getters in every model service. We will use PHPDocs for IDE
     * intellisense.
     * 
     * @param string $name Method name
     */
    public function __call($name, $arguments)
    {
        $snake_cased_fn_name = Str::snake($name);

        if ($this->modelName() === $snake_cased_fn_name) {
            return $this->model;
        }
        if (!is_null($value = $this->model->{$snake_cased_fn_name})) {
            return $value;
        }
        return $this->model->{$name};
    }
}
