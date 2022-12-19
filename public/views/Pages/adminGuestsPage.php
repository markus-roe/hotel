<?php
require_once getcwd()."/public/views/Pages/adminPage.php";
require_once getcwd()."/public/views/Components/container.php";

class AdminguestsPage extends AdminPage
{
    function __construct()
    {
        parent::__construct();

        $this->guestCards = new Container();
    }

    // public function before()
    // {
    //     $this->templates["list-items"]
    // }

    public function parse($params = []) :void
    {
        foreach ($params["guestInfo"] as $guestInfo)
        {
            $userProfilePath = "./admin/userprofile/".$guestInfo["userId"]."";
            $card = new GuestCard();
            $card->parse([...$guestInfo, "user-data-path" => $userProfilePath]);
            $this->addGuestCard($card);
        }
        
        unset($params["guestInfo"]);

        parent::parse($params);
    }
    
    public function addGuestCard($card)
    {

        $this->guestCards->add($card);
        $this->changeContent($this->guestCards);
    }
}
//  /profile/menu/
//  /profile/stammdaten
//  /profile/buchungen