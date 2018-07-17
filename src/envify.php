<?php

if (!function_exists('envify')) {
    function envify(...$args)
    {
        if (count($args) == 1) {
            $prefix = '';
            $config = $args[0];
        } else {
            $prefix = $args[0];
            $config = $args[1];
        }

        foreach ($config as $key => $value) {
            if (is_array($value)) {
                $config[$key] = envify($prefix ? $prefix . '_' . $key : $key, $value);
            } else {
                if (is_numeric($key)) {
                    unset($config[$key]);
                    $key = $value;
                    $value = null;
                }
                $config[$key] = env(strtoupper($prefix . '_' . $key), $value);
            }
        }

        return $config;
    }
}