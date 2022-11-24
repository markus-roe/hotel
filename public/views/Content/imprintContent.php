<?php

require_once getcwd()."/public/views/Components/content.php";

class ImprintContent extends Content
{
    function __construct()
    {        
        parent::__construct();

        $template = new View("imprint");
        $this->insert("contentBody", $template);        
    }
}