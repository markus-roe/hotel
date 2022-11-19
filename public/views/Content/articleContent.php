<?php

require_once getcwd()."/public/views/Components/content.php";

class ArticleContent extends Content
{
    function __construct()
    {
        $this->requireView("Components/content");
        
        parent::__construct();

        $articleTemplate = new View("article");
        $this->insert("contentBody", $articleTemplate);
        
    }
}