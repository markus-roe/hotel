<?php

require_once  getcwd()."/core/controller.php";

class articleController extends Controller
{
    public function init()
    {
        $this->getView("articlePage");
        $articlePage = new articlePage();
        $articlePage->parse();
        $articlePage->render();
    }
}