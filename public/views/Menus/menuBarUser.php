<?php
require getcwd() . "/public/views/Menus/menubar.php";

class UserMenuBar extends MenuBar
{
    function __construct()
    {
        parent::__construct();

        $linkConfig =
        [
            ["href"=>"./booking/bookingdetails/index", "icon"=>Template::readFromFile("./public/templates/icons/reservations"), "title"=>"Buchungen"],
            ["href"=>"./client/profile/index", "icon"=>Template::readFromFile("./public/templates/icons/personalData"), "title"=>"Stammdaten"],
            ["href"=>"./login/logout", "icon"=>Template::readFromFile("./public/templates/icons/logout"), "title"=>"Logout"],
            
        ];
        $links = $this->createLinks($linkConfig);
        $this->menuBarTemplate->parse(["links"=>$links]);
        $this->insert("menuBar", $this->menuBarTemplate);
    }
}