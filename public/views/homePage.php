<?php

require_once getcwd()."/core/component.php";
require_once getcwd()."/public/views/menuLarge.php";
require_once getcwd()."/public/views/content.php";

class HomePage extends Component
{
    function __construct()
    {
        $this->views =
        [
            "header" => new View("header", ["documentTitle"=>"IPSUM-HOTEL"]),
            "menu" => new MenuLarge(),
            "content" => new Content(),
            "footer" => new View("footer")
        ];
    }
}