<?php

/**
 * Components for working with routes
 */
class Router
{

    /**
     * Array of routes
     */
    private $routes;

    /**
     * Constructor
     */
    public function __construct()
    {
        // File with routes
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Getting request string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Request proccesing
     */
    public function run()
    {
        // Getting request string
        $uri = $this->getURI();

        // Check that rout is isset (routes.php)
        foreach ($this->routes as $uriPattern => $path) {

            // Comparing of $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Getting internal path from global path
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Getting controller, action, params

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                // Connect controller
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Create object, coll method (action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }

}
