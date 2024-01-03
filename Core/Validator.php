<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        // validation check to see if the body is empty
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {

        // returns a boolean, will returnt he email if it is truth which is a truthy value
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
