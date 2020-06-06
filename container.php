<?php

if (!function_exists('container')) {
    function container()
    {
        return \Illuminate\Container\Container::getInstance();
    }
}

if (!  function_exists('configuration')) {
    function configuration(string $key)
    {
        return container(\PrettyBx\Support\Contracts\ConfigurationContract::class)->get($key);
    }
}
