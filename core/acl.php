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
    public $errorMsg = ["content-title", "content-body"];

    // [view] :: action => clearance level
    // clearanceLevels: all, client (= user & admin), admin, user

    private array $clearanceList =
    [
        "MainController" => [":index" => "all"],
        "LoginController" => [":logout"=>"client", "attempt::index" => "guest_only", "failure::index" => "guest", ":loginrequest" => "guest_only"],
        "RegistrationController" => [":index" => "guest_only", ":register"=>"guest_only"],
        "ArticleController" => ["post::index" => "all", "preview::index" => "all", "newpost::index" => "admin", "new" => "all", ":post"=>"admin"],
        "ImprintController" => [":index" => "all"],
        "FaqController" => [":index" => "all"],
        "ProfileController" => ["client::index" => "client"],
        "AdminController" => [":index" => "admin", ":updateprofile"=>"admin", ":updatebooking" => "admin"],
        "UserController" => [":index"=> "user_only"],
        "ClientController" => [":updateprofile"=>"client", ":index"=>"client"],
        "BookingController" => ["bookingdetails::index" => "client", "overview::index" => "user", "rooms::index"=>"all", "room::index"=>"all", ":create"=>"user_only", ":bookingId::update" =>"admin"],
        "ErrorController" => [":index"=>"all"]
    ];


    public function __construct($clientModel)
    {
        $this->clientModel = $clientModel;
        $this->clientModel->authenticate();
    }

    private function keyToClearanceLevel($controllerName, $request)
    {

        $view = $request["view"] != "" ? $request["view"] . ":" : "";
        $action = $request["action"] != "" ? ":" . $request["action"] : "";
        $viewActionCombo = $view . $action;

        if (key_exists($action, $this->clearanceList[$controllerName])) {
            $keyToClearanceLevel = $action;
        } else if (key_exists($viewActionCombo, $this->clearanceList[$controllerName])) {
            $keyToClearanceLevel = $viewActionCombo;
        } else {
            $keyToClearanceLevel = "";
        }

        return $keyToClearanceLevel;
    }

    public function isAuthorized($controller, $request)
    {
        $controllerName = get_class($controller);
        $key = $this->keyToClearanceLevel($controllerName, $request);
        $necessaryClearanceLevel = $this->clearanceList[$controllerName][$key];

        if ($necessaryClearanceLevel == "") {
            $this->errorMsg["content-title"] = "Sorry...";
            $this->errorMsg["content-body"] = "This page doesn't seem to exists...";

            return false;
        }

        $userRole = $this->clientModel->user->userRole;

        $hasPermission = true;

        if ($necessaryClearanceLevel == "all") {
            $hasPermission = true;
        }
        elseif ($necessaryClearanceLevel == "admin" && $userRole != "admin")
        {
            $hasPermission = false;
        }
        elseif ($necessaryClearanceLevel == "guest_only" && $userRole != "guest")
        {
            $hasPermission = false;
        } 
        elseif ($necessaryClearanceLevel == "user_only" && $userRole != "user")
        {
            $hasPermission = false;
        }
        elseif ($necessaryClearanceLevel == "client"
                && !($userRole == "admin" || $userRole == "user"))
        {
            $hasPermission = false;
        }

        return $hasPermission;
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
    }
}
