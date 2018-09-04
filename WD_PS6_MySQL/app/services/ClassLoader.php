<?php

/**
 * Class ClassLoader.
 * Autoload register for application classes.
 */
class ClassLoader
{
    /**
     * ClassLoader constructor.
     */
    public function __construct()
    {
        spl_autoload_register(function($class) {
            include __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        });
    }
}
