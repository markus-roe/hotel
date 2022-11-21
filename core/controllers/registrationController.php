<?php

require_once  getcwd()."/core/controller.php";

class RegistrationController extends Controller
{

    public function authenticate()
    {
        // authentifizieren, model zeugs etc.
        $this->redirect("/home/index");
    }

    public function index()
    {
        $this->getView("/Pages/registrationPage");
        $page = new RegistrationPage();
        $page->parse();
        $page->render();
    }

    public function new()
    {

    }
}

/*
    /login
    /login/
*/