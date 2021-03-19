<?php

namespace App\Model\Contracts;

interface PropertyModelContract
{    
    /**
     * Returns the list of properties allowed in the model with their
     * default values.
     * 
     * @return array array containing the default property values
     */
    public function properties();
}
