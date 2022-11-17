<?php

require_once getcwd()."/public/views/page.php";

class ArticlePage extends Page
{
    function __construct()
    {
        parent::__construct();

        $this->requireView("/Content/articleForm");
        $articleForm = new ArticleForm();
        $this->insert("content", $articleForm);
    }
}