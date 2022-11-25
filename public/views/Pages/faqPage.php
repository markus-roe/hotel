<?php

require_once getcwd()."/public/views/Components/page.php";

class FaqPage extends Page
{
    function __construct()
    {
        parent::__construct();

        $content = new Template("faqTemplate", ["page-title" => "FAQ"]);
        $this->changeContent($content);
    }
}