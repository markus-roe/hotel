<?php

require_once getcwd()."/public/views/Components/page.php";

class ArticlePage extends Page
{
    function __construct()
    {
        parent::__construct();
        // username == author name
        $content = new Template("articleTemplate", ["username", "postId", "headline", "content", "subtitle", "picturePath"]);
        $this->changeContent($content);
    }
}