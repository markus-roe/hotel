<?php

require_once  getcwd()."/core/controller.php";

class ErrorController extends Controller
{
    public $errorMsg = ["content-title"=>"Sorry...", "content-body"=> "Something went wrong"];

    public function setErrorMsg($msg)
    {
        $this->errorMsg = $this->errorMsg ?? $msg;
    }

    public function indexAction()
    {
        $this->getTemplate("/Components/page");
        $errorPage = new Page();
        $errorPage->parse([...$this->errorMsg, ...$this->userData]);
        $errorPage->render();
    }


}

/*
    /login
    /login/
*/