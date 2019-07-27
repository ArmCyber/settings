<?php
if (!function_exists('settings')) {
    function settings($key=null, $default=null){
        $settings = app('settings');
        if ($key===null) return $settings;
        if (is_array($key)) return $settings->set($key);
        return $settings->get($key, $default);
    }
}