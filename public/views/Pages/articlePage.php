<?php

require_once getcwd()."/public/views/Components/page.php";

// TODO requiredParam imagePath
class ArticlePage extends Page
{
    function __construct()
    {
        parent::__construct();

        $content = new View("articleTemplate", ["headline", "content", "subtitle", "picturepath"]);
        $this->changeContent($content);
    }
}