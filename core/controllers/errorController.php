<?php

require_once  getcwd()."/core/controller.php";

class ErrorController extends Controller
{

    public function authenticate()
    {
        // authentifizieren, model zeugs etc.
        $this->redirect("/home/index");
    }

    public function index()
    {
        $this->getView("/Components/page");
        $errorPage = new Page();
        $errorPage->parse(["content-title"=>"Sorry...", "content-body"=>"Diese Seite existiert leider nicht"]);
        $errorPage->render();
    }
}

/*
    /login
    /login/
*/