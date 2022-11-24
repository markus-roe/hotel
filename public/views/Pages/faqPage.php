<?php

require_once getcwd()."/public/views/Components/page.php";

class FaqPage extends Page
{
    function __construct()
    {
        parent::__construct();

        $content = new View("faqTemplate");
        $this->changeContent($content);
    }
}