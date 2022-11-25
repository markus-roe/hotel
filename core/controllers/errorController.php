<?php

require_once  getcwd()."/core/controller.php";

class ErrorController extends Controller
{
    public $errorMsg = "";

    public function setErrorMsg($msg)
    {
        $this->errorMsg = $msg;
    }

    public function indexAction()
    {
        $this->getTemplate("/Components/page");
        $errorPage = new Page();
        $data = array_merge($this->userData, $this->errorMsg);
        $errorPage->parse($data);
        $errorPage->render();
    }


}

/*
    /login
    /login/
*/