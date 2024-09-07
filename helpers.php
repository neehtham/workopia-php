<?php

/**
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * load a partial
 * @param string $partial
 * @return void
 */

function loadpartial($partial)
{
    require basePath("views/partials/{$partial}.php");
}

/**
 * load a view
 * @param string $name
 * @return void
 */

function loadview($name)
{
    require basePath("views/{$name}.view.php");
}
