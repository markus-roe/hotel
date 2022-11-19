<?php

require_once getcwd()."/core/component.php";

abstract class Menu extends Component
{
    private $menuLinksConfig;

    function __construct($menuSize)
    {

        $this->menuLinksConfig = 
        [
            [
                "textContent"=> "Home",
                "href"=> "./home/index"
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
                "href"=> "./imprint/index"
            ],
            [
                "textContent"=> "Contact",
                "href"=> "./contact"
            ]
        ];

        $this->menuLinksTemplate = View::readFromFile(getcwd()."/public/templates/"."menuLinks");
        $menuLinksHtml = $this->createLinks();


        $this->views = 
        [
            "menu" => new View("menu", ["menu-links"=>$menuLinksHtml, "menu-size"=>$menuSize, "menu-username"])
        ];
    }

    private function createLinks()
    {
        //TEMPORARY
        $class = "";
        $htmlString = "";
        $params = [];
        foreach($this->menuLinksConfig as $link)
        {
            $params = ["menu-link-href"=>$link["href"], "menu-link-textContent"=>$link["textContent"]];
            $htmlString .= View::parseTemplate($this->menuLinksTemplate, $params);
        }

        return $htmlString;
    }
}