<?php

class Autoloader
{
    private const SRC_PATH = '../vendor/';

    public static function register()
    {
        spl_autoload_register(static function ($class) {
            $file = self::SRC_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}

Autoloader::register();