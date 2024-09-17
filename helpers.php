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

function loadPartial($partial)
{
    require basePath("views/partials/{$partial}.php");
}

/**
 * load a view
 * @param string $name
 * @return void
 */

function loadView($name, $data = [])
{
    $viewPath = basePath("views/{$name}.view.php");
    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    }
}

/**
 * inspect a value and die
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}
