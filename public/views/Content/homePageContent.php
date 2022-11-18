<?php

require_once getcwd()."/public/views/Components/content.php";

class HomePageContent extends Content
{
    function __construct()
    {
        $this->requireView("Components/content");
        
        parent::__construct();

        $homePageContent = new View("homePageBody");
        $this->insert("content", $homePageContent);
        
    }
}