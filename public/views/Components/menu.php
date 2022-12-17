<?php

require_once getcwd()."/core/component.php";

abstract class Menu extends Component
{
    private $menuLinksConfig;
    private $menuLinksHtml;

    function __construct($menuSize)
    {

        $this->menuLinksConfig = 
        [

            [
                "textContent"=> "Home",
                "href"=> "./main/home"
            ],
            [
                "textContent"=> "Book",
                "href"=> "./booking/rooms"
            ],
            [
                "textContent"=> "Help",
                "href"=> "./main/faq"
            ],
            [
                "textContent"=> "Imprint",
                "href"=> "./main/imprint"
            ],
            [
                "textContent"=> "News",
                "href"=> "./article/preview"
            ]
        ];

        $this->menuLinksTemplate = Template::readFromFile(getcwd()."/public/templates/"."menuLinks");
        $menuLinksHtml = $this->createLinks();



        $this->templates = 
        [
            "menu" => new Template("menu", [ "menu-links"=>$menuLinksHtml, "menu-size"=>$menuSize, "homepath"=>"./main/home"])
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
            $htmlString .= Template::parseTemplate($this->menuLinksTemplate, $params);
        }

        return $htmlString;
    }
}