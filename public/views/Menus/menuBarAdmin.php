<?php
require getcwd() . "/public/views/Menus/menubar.php";

class AdminMenuBar extends MenuBar
{
    function __construct()
    {
        parent::__construct();

        $linkConfig =
        [
            ["href"=>"./admin/bookingdetails", "icon"=>Template::readFromFile("./public/templates/icons/reservations"), "title"=>"Buchungen"],
            ["href"=>"./client/profile", "icon"=>Template::readFromFile("./public/templates/icons/personalData"), "title"=>"Stammdaten"],
            ["href"=>"./admin/guests", "icon"=>Template::readFromFile("./public/templates/icons/guests"), "title"=>"Gäste"],
            ["href"=>"./article/newpost", "icon"=>Template::readFromFile("./public/templates/icons/newArticle"), "title"=>"Neuer Artikel"],
            ["href"=>"", "icon"=>Template::readFromFile("./public/templates/icons/logout"), "title"=>"Logout"],
            
        ];
        $links = $this->createLinks($linkConfig);
        $this->menuBarTemplate->parse(["links"=>$links]);
        $this->insert("menuBar", $this->menuBarTemplate);
    }
}