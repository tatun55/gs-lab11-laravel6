<?php

namespace App\Validators;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    /**
     * alpha
     */
    public function validateAlpha($attribute, $value)
    {
        return preg_match("/^[a-z]+$/i", $value);
    }

    /**
     * alpha_num
     */
    public function validateAlphaNum($attribute, $value)
    {
        return preg_match("/^[a-z0-9]+$/i", $value);
    }

    /**
     * alpha_dash
     */
    public function validateAlphaDash($attribute, $value)
    {
        return preg_match("/^[a-z0-9_-]+$/i", $value);
    }
}
