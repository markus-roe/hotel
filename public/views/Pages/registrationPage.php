<?php

require_once getcwd()."/public/views/Components/page.php";
class RegistrationPage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $content = new View("registration", ["cssinputclass", "errormsg"]);
        $this->changeContent($content);
    }
}