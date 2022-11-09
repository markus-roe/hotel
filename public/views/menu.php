<?php

require_once getcwd()."/core/compoundView.php";

abstract class Menu extends Compound
{
    private $menuLinksConfig;

    function __construct($menuSize)
    {

        $this->menuLinksConfig = 
        [
            [
                "textContent"=> "Home",
                "href"=> "./index"
            ],
            [
                "textContent"=> "Book",
                "href"=> "./book"
            ],
            [
                "textContent"=> "Help",
                "href"=> "./help"
            ],
            [
                "textContent"=> "Imprint",
                "href"=> "./imprint"
            ],
            [
                "textContent"=> "Contact",
                "href"=> "./contact"
            ]
        ];

        $menuLinksHtml = $this->createLinks();

        $this->views = 
        [
            "menu" => new View("menu", ["menu-links"=>$menuLinksHtml, "menu-size"=>$menuSize])
        ];
    }

    private function createLinks()
    {
        //TEMPORARY
        $class = "";
        $htmlString = "";
        foreach($this->menuLinksConfig as $link)
        {
            $htmlString .= '<li><a class="'.$class.'" href="'.$link["href"].'">'.$link["textContent"].'</a></li>';
        }

        return $htmlString;
    }
}

class MenuLarge extends Menu
{
    function __construct()
    {
        parent::__construct("large");

    }
}

class MenuSmall extends Menu
{
    function __construct()
    {
        parent::__construct("small");
        
    }
}