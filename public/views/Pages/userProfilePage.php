<?php
//DEPRECATED
require_once getcwd()."/public/views/Pages/userPage.php";

class UserProfilePage extends UserPage
{
    function __construct()
    {
        parent::__construct();
        $persDataConfig =
        [
        "page-title" => "Profile",
        "profile-update-link" => "./client/updateprofile",
        "firstname",
        "surname",
        "username",
        "email",
        "phone"
        ];
        $content = new Template("personalDataTemplate", $persDataConfig);
        $this->changeContent($content);
    }


}
//  /profile/menu/
//  /profile/stammdaten
//  /profile/buchungen