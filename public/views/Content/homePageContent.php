<?php

require_once getcwd()."/public/views/Components/content.php";

class HomePageContent extends Content
{
    function __construct()
    {        
        parent::__construct();

        $homePageContent = new Template("contentBasic");
        $this->insert("contentBody", $homePageContent);
        
    }
}