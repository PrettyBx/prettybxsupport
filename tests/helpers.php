<?php

if (! function_exists('fixture')) {
    function fixture(string $code, array $additional = [])
    {
        $code = str_replace('.', '/', $code);

        $path = __DIR__ . '/fixtures/' . $code . '.php';

        if (! file_exists($path)) {
            throw new \InvalidArgumentException('No such fixture: ' . $path);
        }

        $fixture = include($path);

        if (! is_array($fixture)) {
            throw new \InvalidArgumentException('Fixture must be a valid array');
        }

        return array_merge($fixture, $additional);
    }
}
