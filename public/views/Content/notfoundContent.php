<?php

require_once getcwd()."/public/views/Components/content.php";

class NotFoundPage extends Content
{
    function __construct()
    {
        parent::__construct();

        $homePageContent = new View("contentBasicBody",
        ["content-title" => "Sorry...",
        "content-body" =>
        "Diese Seite existiert leider nicht oder ist zur Zeit nicht erreichbar"]);
        $this->insert("contentBody", $homePageContent);
        
    }
}