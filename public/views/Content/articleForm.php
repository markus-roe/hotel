<?php

// require_once getcwd()."/public/views/content.php";

class ArticleForm extends Content
{
    function __construct()
    {
        $this->requireView("Components/content");
        
        parent::__construct();

        $articleTemplate = new View("article");
        $this->insert("content", $articleTemplate);
        
    }
}