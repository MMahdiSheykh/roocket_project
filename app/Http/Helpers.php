<?php

if (!function_exists('')) {
    function activeRoute($routeName, $firstValue = '', $secondValue = '')
    {
        if (is_array($routeName)) {
            return in_array(Route::currentRouteName(), $routeName) ? $firstValue : $secondValue;
        }
        return Route::currentRouteName() == $routeName ? $firstValue : $secondValue;
    }
}