<?php
require_once getcwd() . "/public/views/Components/page.php";
require_once getcwd() . "/core/user.php";

class AdminPage extends Page
{
    function __construct()
    {
        parent::__construct();
        

        $this->requireTemplate("/Menus/menuBarAdmin");
        $menuBar = new AdminMenuBar();
        $this->insert("menuBar", $menuBar);
    }
}