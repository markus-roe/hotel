<?php

require_once getcwd()."/core/component.php";

class Imprint extends Component
{
    function __construct()
    {
        $this->requireView("menuSmall");
        $this->requireView("content");

        $this->views =
        [
            "header" => new View("header", ["document-title"=>"IPSUM-HOTEL"]),
            "menu" => new MenuSmall(),
            "content" => new Content(),
            "footer" => new View("footer")
        ];
    }
}