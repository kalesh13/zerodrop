<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['email', 'subscription'];

    /**
     * Returns the validation rules of this model.
     * 
     * If a Subscriber model is passed as an argument, then the validation should ignore
     * the given model when performing a unique index check.
     * 
     * @param \App\Models\Subscriber $subscriber
     * @return array
     */
    public static function validationRules($subscriber = null)
    {
        $unique_subscriber = Rule::unique('subscribers');

        if (!is_null($subscriber)) {
            $unique_subscriber = $unique_subscriber->ignoreModel($subscriber);
        }

        return [
            'email' => ['email', 'required', $unique_subscriber],
            'subscription' => 'required|boolean'
        ];
    }
}
