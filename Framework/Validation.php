<?php

namespace Framework;

class Validation
{
    /**
     * validate a string
     *
     * @param string $value
     * @param integer $min
     * @param integer $max
     * @return boolean
     */
    public static function string($value, $min = 1, $max = INF)
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }
    }
    /**
     * validate an email address
     *
     * @param string $value
     * @return mixed
     */
    public static function email($value)
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    /**
     * check if two strings are equal
     * @param string $value1 
     * @param string $value2
     * @return boolean
     */
    public static function match($value1, $value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }
}
