<?php

if (!function_exists('container')) {
    function container()
    {
        return \Illuminate\Container\Container::getInstance();
    }
}

if (!  function_exists('config')) {
    function config(string $key)
    {
        return container()->make(\PrettyBx\Support\Contracts\ConfigurationContract::class)->get($key);
    }
}
