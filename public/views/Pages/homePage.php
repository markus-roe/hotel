<?php

require_once getcwd()."/public/views/Components/Page.php";

class HomePage extends Page
{
    function __construct()
    {
        parent::__construct();

        $this->requireView("Menus/menuLarge");
        $this->requireView("Content/homePageContent");
        
        $menuLarge = new MenuLarge();
        $content = new HomePageContent();
        $this->insert("menu", $menuLarge);
        $this->insert("content", $content);
    }
}