<?php

namespace Framework;

use App\Controllers\ErrorController;
use Error;

class Router
{
    protected $routes = [];
    /**
     * add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function registerRoute($method, $uri, $action)
    {
        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }
    /**
     * Adds a GET route 
     *@param string $uri
     *@param string $controller
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }
    /**
     * Adds a POST route 
     *@param string $uri
     *@param string $controller
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }
    /**
     * Adds a PUT route 
     *@param string $uri
     *@param string $controller
     * @return void
     */
    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }
    /**
     * Adds a DELETE route 
     *@param string $uri
     *@param string $controller
     * @return void
     */
    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Routes the request 
     *@param string $uri
     * @return void
     */
    public function route($uri)
    {
        $RequestMethod = $_SERVER['REQUEST_METHOD'];

        if ($RequestMethod === 'POST' && isset($_POST['_method'])) {
            $RequestMethod = strtoupper($_POST['_method']);
        }
        foreach ($this->routes as $route) {
            // split current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));
            // split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));
            $match = true;
            // check whether num of segments matches
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $RequestMethod)) {
                $params = [];
                $match = true;
                foreach ($uriSegments as $i => $segment) {
                    // inspect(!preg_match('/\{(.+?)\}/', $routeSegments[$i]));
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }
                    //inspectDie($uriSegments);
                    if (isset($routeSegments[$i]) && isset($uriSegments[$i])) {
                        $toMatch = preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches);
                        if ($toMatch) {
                            $params[$matches[1]] = $uriSegments[$i];
                        }
                        if (!$toMatch && count($uriSegments) > 1) {
                            continue;
                        }
                    }

                    if ($match) {
                        // extract controller and controllerMethods
                        $controller = 'App\\Controllers\\' . $route['controller'];
                        $controllerMethod = $route['controllerMethod'];

                        // istantiate the controller and call the controller method
                        $controllerInstance = new $controller();
                        $controllerInstance->$controllerMethod($params);
                    } else {
                        ErrorController::notfound();
                    }
                }
            }
        }
    }
}
