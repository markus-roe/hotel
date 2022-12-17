<?php

require_once getcwd()."/public/views/Components/page.php";
class RegistrationPage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $content = new Template("registration", ["cssinputclass", "errormsg", "loginpath"=>"./login/attempt"]);
        $this->changeContent($content);
    }
}