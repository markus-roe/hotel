<?php

require_once  getcwd()."/core/controller.php";

class ImprintController extends Controller
{

    public function index()
    {
        $this->getView("/Pages/imprintPage");
        $page = new ImprintPage();
        $page->parse();
        $page->render();
    }
}

/*
    /login
    /login/
*/