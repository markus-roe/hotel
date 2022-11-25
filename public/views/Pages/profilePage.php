<?php

require_once getcwd()."/public/views/Components/page.php";
require_once getcwd()."/core/user.php";

class ProfilePage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $content = new Template("personalDataTemplate", ["page-title" => "Profile", "profile-update-link" => "profile/update", "firstname", "surname", "username", "email", "phone"]);
        $this->changeContent($content);
        
    }


}
//  /profile/menu/
//  /profile/stammdaten
//  /profile/buchungen