<?php

require_once getcwd()."/public/views/Pages/adminPage.php";

class ArticlePageAdmin extends AdminPage
{
    function __construct()
    {
        parent::__construct();
        
        $content = new Template("newpostadmin", ["post-link" => "./article/post"]);
        $this->changeContent($content);
    }
}
