<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RecipientValidator.
 *
 * @package namespace App\Validators;
 */
class EmailLogValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        'subject' => 'required',
        'email_template_id' => 'required|exists:email_templates,id',
        'recipients.*.name' => 'required',
        'recipients.*.email' => 'required'
    ];
}
