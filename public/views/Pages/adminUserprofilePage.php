<?php
//DEPRECATED
require_once getcwd()."/public/views/Pages/adminPage.php";

class AdminUserprofilePage extends AdminPage
{
    function __construct()
    {
        parent::__construct();
        $persDataConfig =
        [
        "page-title" => "Profile",
        "profile-update-link" => "./admin/updateprofile/",
        "firstname",
        "surname",
        "username",
        "email",
        "phone"
        ];
        $content = new Template("adminUserDataTemplate", $persDataConfig);
        $this->changeContent($content);
    }
}
//  /profile/menu/
//  /profile/stammdaten
//  /profile/buchungen