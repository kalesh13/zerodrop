<?php

namespace App\Model\Traits;

trait HasPropertyModel
{
    use HasAdditionalProperties;

    /**
     * Model boot function which is overridden to delete the property models whenever
     * this model is deleted. So in cases where a User has to be deleted, UserData models
     * are also deleted automatically.
     */
    protected static function boot()
    {
        static::deleting(function ($model) {
            $model->deleteProperties();
        });

        parent::boot();
    }

    /**
     * Deletes all the property models of this model. 
     * 
     * Done by calling the `HasMany`relation, which returns all the property models, and 
     * performing a delete operation on it.
     */
    public function deleteProperties()
    {
        $relation_name = $this->getPropertyRelationName();

        if (!method_exists($this, $relation_name)) return;

        if ($relations = call_user_func(array($this, $relation_name))) {
            $relations->delete();
        }
    }

    /**
     * Set the given relationship on the model.
     * 
     * Overridden function from the Eloquent\Model class. This sets the relation value on the
     * model. In addition to setting the relation, which is done by the base Model, we call 
     * `loadProperties()` to add the properties on to this model.
     *
     * @param string $relation
     * @param mixed $value
     * 
     * @return $this
     */
    public function setRelation($relation, $value)
    {
        $returnValue = parent::setRelation($relation, $value);

        if ($relation === $this->getPropertyRelationName()) {
            $this->loadProperties($value);
        }
        return $returnValue;
    }

    /**
     * Loads the properties (given as parameter or loaded from relation) as attributes
     * on this model. This facilitates the current model, direct access to the property values 
     * using the property name.
     * 
     * After adding all the properties as attribute to this model, we will hide the relation
     * from the model.
     * 
     * @param array|null $properties
     * @return $this
     */
    public function loadProperties($properties = null)
    {
        $properties = $properties ?: $this->getProperties();

        foreach ($properties ?: array() as $property) {
            $this->setRawAdditionalProperty($property->property, $property->property_value);
        }
        $this->makeHidden($this->getPropertyRelationName());

        return $this;
    }

    /**
     * Returns a property model for the given key if one exists or returns 
     * undefined.
     * 
     * @param string $property_key
     * 
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getProperty($property_key)
    {
        return collect($this->getProperties())->first(function ($property) use ($property_key) {
            return $property->property === $property_key;
        });
    }

    /**
     * Loads all the property models of this model by calling the relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    private function getProperties()
    {
        $relation_name = $this->getPropertyRelationName();

        return $this->$relation_name;
    }

    /**
     * Returns the relation name of the property models. 
     * 
     * For example, relation name of UserData models is userData on the User class.
     * 
     * @return string
     */
    private function getPropertyRelationName()
    {
        $split = explode('\\', $this->getPropertyModelName());

        return lcfirst(end($split));
    }

    /**
     * Returns the property model class name. It is usually the name of this model
     * appended with the string 'Data' in the end. For example, UserData model is the
     * property model of User model. Similary FlyerData is the property model of Flyer
     * model.
     * 
     * @return string
     */
    private function getPropertyModelName()
    {
        return '\\' . ltrim(get_class(), '\\') . 'Data';
    }

    /**
     * Saves the given properties on the model.
     * 
     * If a property model exists for the key, then that model is updated, otherwise a 
     * new model is created.
     * 
     * If the second argument `$allow_all_props` is not set to true, only the properties
     * returned in the `$this->properties()` array will be saved. By default, this
     * argument is set to false.
     * 
     * @param array $properties 
     * @param bool $allow_all_props
     */
    public function saveProperties(array $properties, $allow_all_props = false)
    {
        $existing_relation = call_user_func(array($this, $this->getPropertyRelationName()));

        $model_properties = $this->properties() ?: [];

        foreach ($properties ?: [] as $key => $value) {
            // Update only if the property key exists in the model properties list 
            // or if the allow_all_props flag is set.
            if (!array_key_exists($key, $model_properties) && !$allow_all_props) {
                continue;
            }
            $property_model = $this->getProperty($key) ?: $this->createProperty($key);
            $mutated_value = $this->mutatedPropertyValue($property_model->property, $value);
            $property_model->property_value = $mutated_value;

            if ($existing_relation->save($property_model)) {
                $this->setRawAdditionalProperty($key, $mutated_value);
            }
        }
        return $this;
    }

    /**
     * Creates a new property model for the given key and returns it.
     * 
     * @param string $property_key
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createProperty($property_key)
    {
        $property_model_name = $this->getPropertyModelName();

        $property_model = new $property_model_name;
        $property_model->property = $property_key;

        return $property_model;
    }
}
