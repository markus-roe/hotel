<?php

require_once getcwd()."/public/views/Components/page.php";

class ArticlePageAdmin extends Page
{
    function __construct()
    {
        parent::__construct();

        // $this->previewTemplate = View::readFromFile(getcwd()."/public/templates/articlePreviewCard");
        // array der geparsten Preview-Cards (type == Views)
        $content = new View("newpostadmin", ["post-link" => "./news/article/upload"]);
        $this->changeContent($content);
    }
}