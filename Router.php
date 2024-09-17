<?php
class Router
{
    protected $routes = [];
    /**
     * add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
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
     *@param string $method
     * @return void
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                require basePath($route['controller']);
                return;
            };
        };
        http_response_code(404);
        loadView('errors/404');
        exit;
    }
}
