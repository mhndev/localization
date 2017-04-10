<?php

/**
 * @param $string
 * @param array $parameters
 * @return string
 */
function _t($string, array $parameters = [])
{
    $pattern = '/{{(.*?)}}/';

    $callbackFunction = function ($matches) use ($parameters) {

        $str = $matches[1];
        return $parameters[$str];
    };

    $result = preg_replace_callback($pattern, $callbackFunction, $string);

    return $result;
}
