<?php

namespace Service;

/**
 * Class Validator
 * Class to validate input variables
 *
 * @package util
 */
class Validator
{

    /**
     * @param  mixed $intNumber
     * @return bool
     * return TRUE iff $intNumber is integer
     * return FALSE if $intNumber doesnt integer
     */
    public static function validateInt($intNumber): bool
    {
        return is_int(filter_var($intNumber, FILTER_VALIDATE_INT));
    }

    /**
     * @param  mixed $floatVal
     * @return bool
     * return TRUE iff $floatVal is float
     * return FALSE if $floatVal doesnt float
     */
    public static function validateFloat($floatVal): bool
    {
        return is_float(filter_var($floatVal, FILTER_VALIDATE_FLOAT));
    }

    /**
     * @param  mixed $str
     * @return bool
     * return TRUE iff $str is not empty string
     * return FALSE if $str is empty string
     */
    public static function validateString(string &$str): bool
    {
        return trim($str) !== '';
    }
}
