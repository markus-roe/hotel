<?php
require_once  getcwd()."/core/router.php";
require_once  getcwd()."/core/controller.php";

// require_once "./request.php";


class App
{
    public Router $router;

    function __construct()
    {
        
        $this->router = new Router();
    }

    protected function getController($controllerName)
    {
        $controller = new $controllerName();
        $controller->run();
    }

    protected function controllerExists($controllerName)
    {
        return class_exists($controllerName);
    }

    public function run()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestURI = $_SERVER["REQUEST_URI"];
        $requestURI = str_replace("/hotel", "", $requestURI);

        $request = $this->router->dispatch($requestURI, $requestMethod);

        $controllerName = ucfirst($request["controller"])."Controller";
        
        if ($this->controllerExists($controllerName))
        {
            $controller = new $controllerName($request);
            $controller->execute();
        } else
        {
            // Fehlerseite rendern -> Seite nicht gefunden/existiert nicht
            echo "Seite existiert nicht...";
        }

    }
}