<?php
require getcwd() . "/public/views/Menus/menubar.php";

class AdminMenuBar extends MenuBar
{
    function __construct()
    {
        parent::__construct();

        $linkConfig =
        [
            ["href"=>"", "icon"=>Template::readFromFile("./public/templates/icons/reservations"), "title"=>"Buchungen"],
            ["href"=>"./admin/profile/index", "icon"=>Template::readFromFile("./public/templates/icons/personalData"), "title"=>"Stammdaten"],
            ["href"=>"", "icon"=>Template::readFromFile("./public/templates/icons/guests"), "title"=>"Gäste"],
            ["href"=>"./news/article/newpost/index", "icon"=>Template::readFromFile("./public/templates/icons/newArticle"), "title"=>"Neuer Artikel"],
            ["href"=>"./login/logout", "icon"=>Template::readFromFile("./public/templates/icons/logout"), "title"=>"Logout"],
            
        ];
        $links = $this->createLinks($linkConfig);
        $this->menuBarTemplate->parse(["links"=>$links]);
        $this->insert("menuBar", $this->menuBarTemplate);
    }
}