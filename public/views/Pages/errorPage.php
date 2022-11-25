<?php

require_once getcwd()."/public/views/Components/page.php";
class ErrorPage extends Page
{
    function __construct()
    {
        parent::__construct();
        $content = new Template("contentBasic", ["content-title", "content-body"]);
        $this->changeContent($content);
    }
}