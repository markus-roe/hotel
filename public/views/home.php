<?php

require_once getcwd()."/core/component.php";
require_once getcwd()."/public/views/menu.php";

class HomePage extends Component
{
    function __construct()
    {
        $this->views =
        [
            "header" => new View("header", ["documentTitle"=>"IPSUM-HOTEL"]),
            "menu" => new MenuLarge(),
            "footer" => new View("footer")
        ];
    }
}