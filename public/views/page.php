<?php

require_once getcwd()."/core/compoundView.php";
require_once getcwd()."/public/views/menu.php";
require_once getcwd()."/public/views/content.php";

class Page extends Compound
{
    function __construct()
    {
        $this->views =
        [
            "header" => new View("header", ["documentTitle"=>"IPSUM-HOTEL"]),
            "menu" => new MenuSmall(),
            "content" => new Content(["content-body", "content-headline"]),
            "footer" => new View("footer")
        ];
    }
}