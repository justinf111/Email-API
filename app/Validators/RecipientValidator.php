<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RecipientValidator.
 *
 * @package namespace App\Validators;
 */
class RecipientValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email'
    ];
}
