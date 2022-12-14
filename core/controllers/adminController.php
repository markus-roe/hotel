<?php

require_once  getcwd() . "/core/controllers/clientController.php";
require_once  getcwd() . "/core/user.php";
require_once  getcwd() . "/core/models/clientModel.php";
require_once  getcwd() . "/core/models/bookingModel.php";

class AdminController extends ClientController
{
    public function init()
    {
        parent::init();

    }



    public function indexAction()
    {
        parent::indexAction();
    }

    public function deactivateAction()
    {
        $userId = $this->request["userid"];

        $this->clientModel->deactivateUserById($userId);

        header("Location: ".baseURL. "/admin/guests?res=success");
    }

    public function activateAction()
    {
        $userId = $this->request["userid"];

        $this->clientModel->activateUserById($userId);

        header("Location: ".baseURL. "/admin/guests?res=success"); 
    }

    public function renderGuestsPage()
    {
        $this->getTemplate("/Components/guestCard");
        $guests = $this->clientModel->getAllGuests();
        // var_dump($guests);
        // return 0;
        $page = new $this->pageName();
        if ($this->request["res"] == "success")
        {
            $page->triggerPopup("<span style='font-size:1.5rem'>🥳</span> Update erfolgreich!");
        }
        $page->parse([...$this->userData, "guestInfo"=>$guests, "content-title" => "Gäste"]);
        $page->render();
    }

    public function updateprofileAction($userId = null)
    {
        parent::updateprofileAction($this->request["userid"]);

        header("Location: ../../admin/guests?res=success");
    }

    public function renderBookingdetailsPage($params = null)
    {
        $bookingPage = new $this->pageName();
        $this->getTemplate("/Content/bookingCard");
        $bookingModel = new BookingModel();

        $bookingData = $bookingModel->getAllBookings();

        $bookingCardArr = [];
        $pageText = ["content-title" => "Buchungen", "content-body" => "Noch keine Buchungen vorhanden!"];

        if (count($bookingData) <= 0) {
            $bookingPage->parse([...$this->userData, ...$pageText]);
            $bookingPage->render();
            return 0;
        }
        
        if ($this->request["res"] == "success") {
            $bookingPage->triggerPopup("<span style='font-size:1.5rem'>🥳</span> Buchung erfolgreich!");
        }
        $pageText["content-body"] = "";
        $bookingPage->createBookingCards($bookingData);
        $bookingPage->parse([...$this->userData, ...$bookingCardArr, ...$pageText]);
        $bookingPage->render();


        return 1;
    }

    public function renderUserprofilePage()
    {
        
        if (!array_key_exists("userid", $this->request))
        {
            header("Location: " . baseURL . "/error");
            die();
        }
        $profilePage = new $this->pageName();
        $foreignUser = $this->clientModel->getUserById($this->request["userid"]);
        $this->getTemplate("/Menus/menuSmall");
        $menu = new MenuSmall();
        $menu->parse([...$this->userData]);
        
        $userStatusFormLink = $foreignUser["active"] ? "./admin/deactivate/".$foreignUser['userId'] : "./admin/activate/".$foreignUser["userId"];
        $userStatusBtnTxt = $foreignUser["active"] ? "Deaktivieren" : "Aktivieren";
        $profilePage->insert("menu", $menu);            
        
        if ($this->request["res"] == "success") {
            $profilePage->triggerPopup("<span style='font-size:1.5rem'>🥳</span> Update erfolgreich!");
        }
        $profilePage->parse([...$foreignUser, "userStatusFormLink"=>$userStatusFormLink, "userStatusBtnTxt"=>$userStatusBtnTxt]);
        $profilePage->render();
    }
}

/*
    /login
    /login/
*/