<?php
require_once  getcwd() . "/core/router.php";
require_once  getcwd() . "/core/acl.php";
require_once  getcwd() . "/core/models/clientModel.php";
require_once  getcwd() . "/core/controller.php";
require_once  getcwd() . "/public/views/Pages/errorPage.php";

// require_once "./request.php";


class App
{

    public Router $router;
    private $controllerRoot = "./core/controllers/";

    function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->router = new Router();
        $this->acl = new AccessControl($this->clientModel);
    }

    protected function getController($controllerName)
    {
        $controllerPath = $this->controllerRoot;
        $controllerPath .= $controllerName . ".php";

        if (file_exists($controllerPath)) {
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
        // !!!
        // IMPROVE I'm ugly
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestURI = $_SERVER["REQUEST_URI"];
        $requestURI = str_replace("/hotel", "", $requestURI);

        $request = $this->router->dispatch($requestURI, $requestMethod);

        $requestAction = @$request["action"] . "Action" ?? "";
        $requestController = @$request["controller"] ?? "";
        $controllerFileName = @$request["controller"] . "Controller";
        $controllerName = ucfirst(@$request["controller"]) . "Controller";

        $this->getController($controllerFileName);

        $controllerExists = $this->getController($controllerFileName);

        $actionExists = $controllerExists
        ? method_exists($controllerName, $requestAction)
        : false;
        

        if (!$controllerExists || !$actionExists) {
            $this->getController("errorController");
            $errPage = new ErrorPage();
            $errPage->parse(["content-title"=>"Sorry...", "content-body"=>"Diese Seite existiert leider nicht..."]);
            $errPage->render();
            return;
        }

        $controller = new $controllerName($request, $this->clientModel);

        if ($this->acl->isAuthorized($controller, $request)) {
            $controller->execute();
            $controller->$requestAction();
        } else {
            $errPage = new ErrorPage();
            $errPage->parse(["content-title"=>"Sorry...", "content-body"=>"Sie haben keine Berechtigung sie zu besuchen"]);
            $errPage->render();
        }
    }
}


// redirect to error msg, send msg mit