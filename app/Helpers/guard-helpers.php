<?php

if (!function_exists('guard_name_options')) {
    function guard_name_options()
    {
        $guards = config('auth.guards');
        $options = [];
        foreach ($guards as $key => $value) {
            $options[] = [
                'label' => ucfirst($key),
                'value' => $key,
            ];
        }
        return $options;
    }
}