<?php
require_once  getcwd()."/core/router.php";
// require_once  getcwd()."/core/controller.php";

// require_once "./request.php";


class App
{
    public Router $router;
    private $controllerRoot = "./core/controllers/";

    function __construct()
    {
        
        $this->router = new Router();
    }

    protected function getController($controllerName)
    {
        $controllerPath = $this->controllerRoot;
        $controllerPath .= $controllerName.".php";
        
        if (file_exists($controllerPath))
        {
            require_once $controllerPath;
            return true;
        }
        
        return false;
        // return $controllerExists;
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
        $controllerFileName = $request["controller"]."Controller";
        $controllerName = ucfirst($request["controller"])."Controller";

        if ($this->getController($controllerFileName))
        {
            $controller = new $controllerName($request);
            $controller->execute();
        }
         else
        {
            // Fehlerseite rendern -> Seite nicht gefunden/existiert nicht
            echo "Seite existiert nicht...";
        }

    }
}