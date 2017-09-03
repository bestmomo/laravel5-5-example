<?php

if (!function_exists('currentRoute')) {
    function currentRoute($route)
    {
        return request()->url() == route($route) ? ' class=current' : '';
    }
}

if (!function_exists('currentRouteBootstrap')) {
    function currentRouteBootstrap($route)
    {
        return request()->url() == route($route) ? ' class=active' : '';
    }
}

if (!function_exists('user')) {
    function user($id)
    {
        return \App\Models\User::findOrFail($id);
    }
}

if (!function_exists('locales')) {
    function locales()
    {
        $file = resolve (\Illuminate\Filesystem\Filesystem::class);
        $locales = [];
        $results = $file->directories(resource_path ('lang'));
        foreach ($results as $result) {
            $name = $file->name($result);
            if($name !== 'vendor') {
                $locales[$name] = $name;
            }
        }
        return $locales;
    }
}

if (!function_exists('timezones')) {
    function timezones()
    {
        $zones_array = [];
        $timestamp = time();
        foreach(timezone_identifiers_list() as $zone) {
            date_default_timezone_set($zone);
            $zones_array[$zone] = 'UTC' . date('P', $timestamp);
        }
        return $zones_array;
    }
}

if (!function_exists('setTabActive')) {
    function setTabActive()
    {
        return request ()->has('page') ? request ('page') : 1;
    }
}

if (!function_exists('thumb')) {
    function thumb($url)
    {
        return \App\Services\Thumb::makeThumbPath ($url);
    }
}

