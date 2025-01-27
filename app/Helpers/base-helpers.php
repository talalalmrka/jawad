<?php
if (!function_exists('css_classes')) {
    function css_classes($classes)
    {
        return Arr::toCssClasses($classes);
    }
}