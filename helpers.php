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
    require basePath("App/views/partials/{$partial}.php");
}

/**
 * load a view
 * @param string $name
 * @return void
 */

function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
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
function inspectDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

/**
 * inspect a value 
 *
 * @param string $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * format a number in a readable format
 *
 * @param integer $salary
 * @return string
 */
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}

/**
 * Sanitize the given data string
 *
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}
/**
 * redirect to another page
 *
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit();
}
