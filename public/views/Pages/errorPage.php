<?php

require_once getcwd()."/public/views/Components/Page.php";
class ErrorPage extends Page
{
    function __construct()
    {
        parent::__construct();
        $content = new View("contentBasic", ["content-title", "content-body"]);
        $this->changeContent($content);
    }
}