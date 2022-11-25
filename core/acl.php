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
    
    // [view] : action => clearance level

    private $clearanceList = 
    [
        "HomeController" => ["index" => "all"],
        "LoginController" => ["attempt:index" => "guest", "attemptfailed:index"=>"guest", "loginrequest" => "guest"],
        "RegistrationController" => ["missing:index"=>"guest", "passwordnotmatching:index"=>"guest", "newuser:index"=>"guest"],
        "ArticleController" => ["post:index" => "all", "preview:index" => "all", "newpost:index" => "all", "new" => "all"],
        "ImprintController" => ["index" => "all"],
        "FaqController" => ["index" => "all"],
        "ProfileController" => ["admin:index" => "admin", "user:index" => "user"]
    ];


    public function __construct($clientModel)
    {
        $this->clientModel = $clientModel;
        $this->clientModel->authenticate();
    }

    public function isAuthorized($controller, $request)
    {
        
        $controllerName = get_class($controller);
        $view = $request["view"] != "" ? $request["view"].":" : "";
        $viewActionCombo = $view.$request["action"];

        $clearanceLevel = $this->clearanceList[$controllerName][$viewActionCombo] ?? false;
        
        if (!$clearanceLevel)
        {
            return true;
        }

        $userRole = $this->clientModel->user->userRole;

        // TEMPORARY

        if ($clearanceLevel == "all" || $userRole == $clearanceLevel || $clearanceLevel == null)
        {
            return true;
        }
        elseif ($viewActionCombo == "index" && $userRole == "admin" || $userRole == "user")
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