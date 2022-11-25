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
                "href"=> "./home/index"
            ],
            [
                "textContent"=> "Book",
                "href"=> "./book"
            ],
            [
                "textContent"=> "Help",
                "href"=> "./faq/index"
            ],
            [
                "textContent"=> "Imprint",
                "href"=> "./imprint/index"
            ],
            [
                "textContent"=> "News",
                "href"=> "./news/article/preview/index"
            ]
        ];

        $this->menuLinksTemplate = Template::readFromFile(getcwd()."/public/templates/"."menuLinks");
        $menuLinksHtml = $this->createLinks();



        $this->templates = 
        [
            "menu" => new Template("menu", ["profilepath", "menu-links"=>$menuLinksHtml, "menu-size"=>$menuSize, "username"])
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