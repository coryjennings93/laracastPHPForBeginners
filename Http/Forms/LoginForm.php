<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class LoginForm
{
    protected $errors = [];


    // will automatically validate the form when a LoginForm is instantiated
    public function __construct(public array $attributes)
    {

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {

            $this->errors['password'] = 'Please provide a valid password.';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->getErrors(), $this->attributes);
    }

    // helper method to see if the errors array contains anything; checks to see if validation in constructor failed
    public function failed()
    {
        return count($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
