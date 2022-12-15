<?php
require_once getcwd() . "/public/views/Components/page.php";
require_once getcwd() . "/core/user.php";

//? necessary
class ClientPage extends Page
{
    function __construct()
    {
        parent::__construct();

        // $this->requireTemplate("/Menus/menubar");
        // $this->menuBarTemplate = new MenuBar();
    }

}