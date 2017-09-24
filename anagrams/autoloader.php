<?php

require_once('Utils.php');

/**
 * @param string $className
 *
 * @return bool
 */
function __autoload($className)
{
    $file = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';

    if (!file_exists($file)) {
        return false;
    }

    require_once $file;

    return true;
}