<?php

//? Controller sollte selbst checken ob URL-Parameter valide sind,
//? soll selbst URL-Parameter Action-Methoden aufrufen
require_once "./core/utils.php";
require_once "./core/controllers/errorController.php";

 class Controller
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

    protected function renderErrorPage($errorMsg=null)
    {
        $errorMsg = $errorMsg ?? ["content-title" => "Sorry", "content-body" => "This page doesn't seem to exist yet!"];
        $this->getTemplate("/Components/page");
        $errorPage = new Page();
        $errorPage->parse($errorMsg);
        $errorPage->render();
    }

    public function indexAction()
    {
        $this->pageName = ucfirst($this->requestedView)."Page";
        $requestedMethod = "render".ucfirst($this->requestedView)."Page";

        if (method_exists($this, $requestedMethod))
        {
            $this->getTemplate("/Pages/$this->pageName");
            $this->$requestedMethod();
        }
    }

    public function init()
    {
    }

    protected function redirect($url)
    {
        header("Location: ./".$url);
        die();
    }

    protected function renderView()
    {
        $viewPath = $this->viewRootPath;
        $viewPath .= $this->request["view"];
    }

    protected function getTemplate($viewName)
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
        $this->requestedView = $this->request["view"] ?? "";
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