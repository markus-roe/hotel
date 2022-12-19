<?php

require_once getcwd()."/public/views/Components/page.php";

class RoomPage extends Page
{
    function __construct($roomData)
    {
        parent::__construct();

        $content = new Template("bookRoomTemplate", ["actionPath"=>"./booking/".$roomData["roomId"]."/create", "description" => $roomData["description"], "name" => $roomData["name"], "picturePath" => $roomData["picturePath"], "description" => $roomData["description"]]);
        $this->changeContent($content);
    }
}
