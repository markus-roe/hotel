<?php

require_once getcwd()."/public/views/Components/page.php";

class RoomPage extends Page
{
    function __construct()
    {
        parent::__construct();
        // username == author name
        $params =
        [
            "room-description" => "<li>blabla</li><li>blabla</li>",
            "name" => "24K Purple Haze Suite",
            "picturePath" => "./public/images/hotelroom1.jpg",
            "description" => "Aliquip in adipisicing anim ut cillum in aliqua exercitation est deserunt. Eiusmod reprehenderit veniam anim dolore incididunt reprehenderit aliqua in Lorem. Irure est Lorem ad adipisicing. Minim ipsum proident officia dolore non labore eiusmod nostrud proident magna qui laborum. Et nisi duis pariatur eiusmod quis elit in aliqua. Magna elit Lorem non commodo voluptate tempor ad excepteur et elit esse excepteur. Eu deserunt irure exercitation adipisicing quis ad aliquip ipsum laboris.

Lorem cillum duis voluptate aute nisi ipsum nisi commodo non. Consectetur incididunt sunt consectetur anim commodo proident nulla deserunt esse sunt nulla dolor adipisicing veniam. Ea officia aliquip cillum sunt. Proident occaecat qui proident velit cupidatat ut.

Exercitation quis exercitation sunt commodo consectetur. Commodo nisi reprehenderit proident excepteur deserunt deserunt reprehenderit fugiat consectetur cupidatat proident ullamco. Qui quis qui occaecat duis magna magna dolor aliquip magna ipsum dolor. Duis quis occaecat nulla magna et exercitation sint velit enim laborum esse. Pariatur veniam id ipsum nulla quis elit qui est. Ut consectetur aute incididunt adipisicing non ad consequat qui cupidatat. Lorem non adipisicing ea labore do dolor irure id irure cupidatat do mollit."
        ];

        $content = new Template("bookRoomTemplate", $params);
        $this->changeContent($content);
    }
}