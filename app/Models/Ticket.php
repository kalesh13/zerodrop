<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    /**
     * Returns the validation rules of this model.
     * 
     * @return array
     */
    public static function validationRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'message' => 'required',
        ];
    }
}
