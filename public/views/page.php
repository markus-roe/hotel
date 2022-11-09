<?php

require_once getcwd()."/core/compoundView.php";
require_once getcwd()."/public/views/menu.php";

class Page extends Compound
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