<?php

require_once getcwd()."/public/views/Components/page.php";
require_once getcwd()."/core/user.php";

class ProfilePage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $profileLinks = [];
        $profileLinksHtml = $this->createProfileLinks($profileLinks);
        $content = new Template("profileContentTemplate", ["profile-links"]);


        $content = new View("personalDataTemplate", ["page-title" => "Stammdaten", "profile-update-link" => "test", "firstname", "surname", "username", "email", "phone"]);
        // $content->parse();
        $this->changeContent($content);
        
    }


}
//  /profile/menu/
//  /profile/stammdaten
//  /profile/buchungen