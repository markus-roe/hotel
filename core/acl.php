<?php

class Clearance
{
    public static function Admin()
    {

    }
}

class AccessControl
{
    private $user;
    private $controllerRoot = "./core/controllers/";
    public $errorMsg;
    private $clearanceList = 
    [
        "HomeController" => ["index" => "all"],
        "LoginController" => ["index" => "guest", "loginrequest" => "guest"],
        "RegistrationController" => ["index" => "guest"],
        "ArticleController" => ["index" => "all", "overview" => "all", "create" => "admin"],
        "ImprintController" => ["index" => "all"]
    ];


// TODO
    public function __construct($clientModel)
    {
        $this->clientModel = $clientModel;
        $this->clientModel->authenticate();
    }

    public function isAuthorized($controller, $request)
    {
        
        $controllerName = get_class($controller);
        
        $clearanceLevel = $this->clearanceList[$controllerName][$request["action"]];
        $userRole = $this->clientModel->user->userRole;
        echo ($userRole);
        if ($clearanceLevel == "all" || $userRole == $clearanceLevel)
        {
            return true;
        }
        elseif ($request["action"] == "index" && $userRole == "admin" || $userRole == "user")
        {
            $this->errorMsg = ["content-title"=>"It's not us, it's you", "content-body" => "You are already logged in"];
        }

        elseif ($clearanceLevel == "user")
        {
            if ($userRole == "admin")
            {
                return true;
            }
        }
        else
        {
            $this->errorMsg = ["content-title"=>"It's not us, it's you", "content-body" => "You don't seem to have enough clearance"];

            return false;
        }
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
    }
    
}