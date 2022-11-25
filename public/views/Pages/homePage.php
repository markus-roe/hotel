<?php

require_once getcwd()."/public/views/Components/page.php";

class HomePage extends Page
{
    function __construct()
    {
        parent::__construct();

        $this->requireTemplate("Menus/menuLarge");
        $this->requireTemplate("Content/homePageContent");
        
        $menuLarge = new MenuLarge();
        $content = new HomePageContent();
        $this->insert("menu", $menuLarge);
        $this->insert("content", $content);
    }
}