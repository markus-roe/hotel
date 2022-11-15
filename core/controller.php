<?php

abstract class Controller
{
    protected $viewRootPath = "./public/views/";

    function __construct($request)
    {
        $this->request = $request;
    }

    public function init()
    {

    }

    protected function redirect($url)
    {
        header("Location: ".$url);
        die();
    }

    protected function renderView()
    {
        $viewPath = $this->viewRootPath;
        $viewPath .= $this->request["view"];
    }

    protected function getView($viewName)
    {
        $viewPath = $this->viewRootPath;
        $viewPath .= $viewName.".php";
        
        if (file_exists($viewPath))
        {
            require_once $viewPath;
            return 1;
        }

        return 0;
    }

    public function before()
    {
        // user authentifizieren / validieren etc
        // userdaten laden aus DB
    }

    public function after()
    {

    }

    public function execute()
    {
        $this->before();
        $this->init();
        $this->after();
    }
}