<?php

//! Controller sollte selbst checken ob URL-Parameter valide sind,
//! soll selbst URL-Parameter Action-Methoden aufrufen
abstract class Controller
{

    function __construct($request)
    {
        $this->viewRootPath = getcwd()."/public/views/";
        $this->request = $request;
    }

    public function authenticate()
    {
        
    }

    public function index()
    {
        
    }

    public function init()
    {
        if ($this->request["method"] == "GET")
        {
            $this->handleGetRequest();
        }
        if ($this->request["method"] == "POST")
        {
            $this->handlePostRequest();
        }
    }

    protected function handleGetRequest()
    {

    }
    
    protected function handlePostRequest()
    {

    }

    protected function renderErrorView()
    {

    }


    protected function redirect($url)
    {
        header("Location: ..".$url);
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
        $this->authenticate();
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