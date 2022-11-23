<?php

//? Controller sollte selbst checken ob URL-Parameter valide sind,
//? soll selbst URL-Parameter Action-Methoden aufrufen


abstract class Controller
{
    protected $userData;

    function __construct($request, $clientModel)
    {
        //! $clientController = new ClientController();
        $this->viewRootPath = getcwd()."/public/views/";
        $this->request = $request;
        $this->clientModel = $clientModel;
        $this->userData = get_object_vars($this->clientModel->user);

    }

    // public function authenticate()
    // {
    //     var_dump($_SESSION);
    //     if ($this->clientModel->authenticate())
    //     {
    //         $this->userData = get_object_vars($this->clientModel->user);
    //         var_dump($this->userData);
    //         return true;
    //     }
    //     var_dump($this->userData);

    //     $this->userData = get_object_vars($this->clientModel->user);

    //     return false;
    // }

    public function indexAction()
    {
        
    }

    public function init()
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
        // $this->authenticate();
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