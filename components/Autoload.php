<?php

/**
 * Function __autoload for automatic classes conection
 */
function __autoload($class_name)
{
    // Classes dirs
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    foreach ($array_paths as $path) {

        // Path to class file
        $path = ROOT . $path . $class_name . '.php';

        // If isset - load it
        if (is_file($path)) {
            include_once $path;
        }
    }
}
