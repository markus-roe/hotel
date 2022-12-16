<?php
require_once getcwd() . "/public/views/Components/page.php";
require_once getcwd() . "/core/user.php";

class UserPage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $this->requireTemplate("/Menus/menuBarUser");
        $menuBar = new UserMenuBar();
        $this->insert("menuBar", $menuBar);
    }
}