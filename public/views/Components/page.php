<?php

require_once getcwd()."/core/component.php";
// require_once getcwd()."/public/views/content.php";
class Page extends Component
{
    function __construct()
    {
        $this->requireView("Menus/menuSmall");
        $this->requireView("/Components/content");

        $this->views =
        [
            "header" => new View("header", ["document-title"=>"IPSUM-HOTEL"]),
            "menu" => new MenuSmall(),
            "content" => new Content(),
            "footer" => new View("footer")
        ];
    }

    protected function changeContent($newContent)
    {
        $this->views["content"]->changeContentBody($newContent);
    }
}