<?php

require_once  getcwd()."/core/controller.php";

class ArticleController extends Controller
{
    public function init()
    {

    }

    public function index()
    {
        if (isset($this->request["articleid"]))
        {
            echo "article id: ".$this->request["articleid"];
        }
    }

    public function overview()
    {
        $this->getView("/Pages/ArticlePreviewPage");

        $page = new ArticlePreviewPage();
        $mockArticles = [
            ["headline"=>"Wasserrohrbruch im 2ten Stock", "preview"=>"Lorem Ipsum dolor blablabla", "author"=>"Max Sinnl"],
            ["headline"=>"Familien SM-Workshop", "preview"=>"Lorem Ipsum dolor blablabla", "author"=>"Markus Rösner"],
            ["headline"=>"Familien SM-Workshop", "preview"=>"Lorem Ipsum dolor blablabla", "author"=>"Markus Rösner"],

                        ];
        $page->addPreviews($mockArticles);
        $page->parse();
        $page->render();
    }

    public function new()
    {
        
            $this->getView("/Pages/articlePageAdmin");
            $page = new ArticlePageAdmin();
            $page->parse();
            $page->render();
    }

    public function postarticle()
    {

    }
}