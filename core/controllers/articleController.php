<?php

require_once  getcwd()."/core/controller.php";

class ArticleController extends Controller
{
    public function init()
    {

    }

    public function index()
    {
        $this->getView("articlePage");
        $articlePage = new articlePage();
        $articlePage->parse();
        $articlePage->render();
    }
}