<?php

require_once getcwd()."/public/views/Components/Page.php";
class RegistrationPage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $content = new View("registration");
        $this->changeContent($content);
    }
}