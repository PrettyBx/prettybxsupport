<?php

if (!function_exists('container')) {
    function container()
    {
        return \Illuminate\Container\Container::getInstance();
    }
}
