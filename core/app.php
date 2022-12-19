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

        if ($controllerName == "Controller") {
            header("Location: " . baseURL . "/main/home");

            return;
        }

        if ($requestMethod == "GET") {
            $controller = new $controllerName($request, $this->clientModel);

            $viewExists = method_exists($controllerName, "render" . ucfirst($request["view"]) . "Page");

            if ($viewExists) {
                $controller->execute();
                $controller->indexAction();

                return;
            }
        }

        if ($requestMethod == "POST") {
            $controller = new $controllerName($request, $this->clientModel);

            $controller->execute();
            $controller->$requestAction();

            return;
        }

        if ($controllerName == "Controller") {
            header("Location: " . baseURL . "/main/home");

            return;
        }

        $errPage = new ErrorPage();
        $errPage->parse(["content-title" => "Sorry...", "content-body" => "Diese Seite existiert leider nicht..."]);
        $errPage->render();
    }
}


// redirect to error msg, send msg mit