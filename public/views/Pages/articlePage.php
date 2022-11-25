<?php

require_once getcwd()."/public/views/Components/page.php";

// TODO requiredParam imagePath
class ArticlePage extends Page
{
    function __construct()
    {
        parent::__construct();
        // username == author name
        $content = new View("articleTemplate", ["username", "postId", "headline", "content", "subtitle", "picturePath"]);
        $this->changeContent($content);
    }
}