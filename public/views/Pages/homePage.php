<?php

require_once getcwd()."/core/component.php";
require_once getcwd()."/public/views/menuLarge.php";

class HomePage extends Component
{
    function __construct()
    {
        $this->requireView("Components/homePage");
        $this->requireView("Components/content");

        $this->views =
        [
            "header" => new View("header", ["document-title"=>"IPSUM-HOTEL"]),
            "menu" => new MenuLarge(),
            "content" => new Content(),
            "footer" => new View("footer")
        ];
    }
}