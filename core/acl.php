<?php

class Clearance
{
    public static function Admin()
    {

    }
}

class AccessControl
{
    private $controllerRoot = "./core/controllers/";
    private $controllerPath;

// TODO
    public function __construct($controllerPrefix, $request)
    {
        $controllerName = $this->controllerExists($controllerPrefix);
        if (method_exists())
    }

    protected function controllerExists($controllerPrefix)
    {
        $controllerPath = $this->controllerRoot;
        $controllerPath .= $controllerPrefix.".php";
        
        if (file_exists($controllerPath))
        {
            return $controllerPath;
        }
        
        return false;
    }
}