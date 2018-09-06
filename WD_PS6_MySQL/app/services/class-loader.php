<?php

spl_autoload_register(function($class) {
    include dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});