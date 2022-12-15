<?php
require getcwd() . "/public/views/Menus/menubar.php";

class UserMenuBar extends MenuBar
{
    function __construct()
    {
        parent::__construct();

        $linkConfig =
        [
            ["href"=>"", "icon"=>Template::readFromFile("/icons/reservations"), "title"=>"Buchungen"],
            ["href"=>"", "icon"=>Template::readFromFile("/icons/personalData"), "title"=>"Stammdaten"],
            ["href"=>"", "icon"=>Template::readFromFile("/icons/logout"), "title"=>"Logout"],
            
        ];
        $links = $this->createLinks($linkConfig);
        $this->menuBarTemplate->parse(["links"=>$links]);
        $this->insert("menuBar", $this->menuBarTemplate);
    }
}