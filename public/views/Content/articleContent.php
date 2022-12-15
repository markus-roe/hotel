<?php

require_once getcwd()."/public/views/Components/content.php";

class ArticleContent extends Content
{
    function __construct()
    {
        $this->requireTemplate("Components/content");
        
        parent::__construct();

        $articleTemplate = new Template("article");
        $this->insert("contentBody", $articleTemplate);
        
    }
}