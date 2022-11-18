<?php

require_once getcwd()."/core/component.php";
// require_once getcwd()."/public/views/content.php";
class Page extends Component
{
    function __construct()
    {
        $this->requireView("Menus/menuSmall");

        $this->views =
        [
            "header" => new View("header", ["document-title"=>"IPSUM-HOTEL"]),
            "menu" => new MenuSmall(),
            "content" => null,
            "footer" => new View("footer")
        ];
    }
}