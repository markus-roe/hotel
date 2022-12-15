<?php

require_once getcwd()."/core/component.php";
// require_once getcwd()."/public/views/content.php";
class Page extends Component
{
    function __construct()
    {
        $this->requireTemplate("Menus/menuSmall");
        $this->requireTemplate("/Components/content");

        $this->templates =
        [
            "header" => new Template("header", ["document-title"=>"IPSUM-HOTEL", "username"]),
            "menu" => new MenuSmall(),
            "menuBar" => new Template("empty"),
            "content" => new Content(),
            "footer" => new Template("footer")
        ];
    }

    protected function changeContent($newContent)
    {
        $this->templates["content"]->changeContentBody($newContent);
    }
}