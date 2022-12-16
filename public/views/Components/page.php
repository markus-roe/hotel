<?php

require_once getcwd()."/core/component.php";
// require_once getcwd()."/public/views/content.php";
class Page extends Component
{
    function __construct()
    {
        $this->requireTemplate("Menus/menuSmall");
        $this->requireTemplate("/Components/content");
        $this->popupEl = "";
        
        $this->templates =
        [
            "header" => new Template("header", ["document-title"=>"IPSUM-HOTEL", "username"]),
            "popup"=>null,
            "menu" => new MenuSmall(),
            "menuBar" => new Template("empty"),
            "content" => new Content(),
            "footer" => new Template("footer")
        ];
    }

    public function triggerPopup($msg)
    {
        $popupEl = new Template("popup", ["popup-body"=>$msg]);
        $popupEl->parse();
        
        $this->insert("popup", $popupEl);
    }

    protected function changeContent($newContent)
    {
        $this->templates["content"]->changeContentBody($newContent);
    }
}