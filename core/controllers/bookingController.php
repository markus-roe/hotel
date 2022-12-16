<?php
require_once  getcwd() . "/core/controllers/clientController.php";
require_once  getcwd() . "/core/models/bookingModel.php";

function booking_mock()
{
    return [[
        "status" => "new",
        "firstname" => "Max",
        "surname" => "Sinnl",
        "startDate" => "20.11.2022",
        "endDate" => "31.12.2022",
        "status" => "new",
        "services"  =>  ["Haustiere", "Parkplatz"]
    ]];
}

class BookingController extends ClientController
{

    public function init()
    {
        parent::init();
        $this->bookingModel = new BookingModel();
    }

    public function indexAction()
    {
        parent::indexAction();
    }

    public function renderRoomsPage()
    {
        $this->getTemplate("/Pages/roomsPreviewPage");
        $page = new RoomsPreviewPage($this->bookingModel->getAllRooms());
        $page->parse($this->userData);
        $page->render();
    }

    public function renderRoomPage()
    {
        $this->getTemplate("/Pages/roomPage");
        $bookingModel = new BookingModel();
        $currentRoom = $bookingModel->getRoomById($this->request["id"]);
        $page = new RoomPage($currentRoom);
        
        if ($this->request["res"] == "invalid")
        {
            $page->triggerPopup("Dieses Zimmer ist im gewünschten Zeitraum leider nicht verfügbar...");
        }

        $page->parse([...$this->userData]);
        $page->render();
    }


    public function createAction()
    {
        $bookingModel = new BookingModel();

        $inputIsValid =
        isset($_POST["startDate"]) &&
        isset($_POST["endDate"]) &&
        $_POST["startDate"] != "" &
        $_POST["endDate"] != "";

        if (!$inputIsValid || !$bookingModel->createBooking($this->userData["userId"], $this->request["roomid"], $_POST["startDate"], $_POST["endDate"])) {
            header("Location: ".baseURL."/booking/room/{$this->request["roomid"]}/index?res=invalid");

            return 0;
        }
        // TODO redirect to personal booking page
        header("Location: ".baseURL."/booking/bookingdetails/index?res=success");

    }

    // TODO
    public function renderBookingdetailsPage($params = null)
    {
        $this->getTemplate("/Content/bookingCard");
        $bookingModel = new BookingModel();
        $bookingData = $bookingModel->getBookingById(@$this->request["id"]);
        $bookingPage = new $this->pageName($bookingData);
        $bookingCardArr = [];
        $pageText = ["content-title" => "Buchungen", "content-body" => "Noch keine Buchungen vorhanden!"];

        if (count($bookingData) > 0) {
            // TODO hier
            $pageText["content-body"] = "";

            return 0;
        }

        if ($this->request["res"] == "success")
        {
            $bookingPage->triggerPopup("<span style='font-size:1.5rem'>🥳</span> Buchung erfolgreich!");
        }
        $bookingPage->parse([...$this->userData, ...$bookingCardArr, ...$pageText]);
        $bookingPage->render();


        return 1;
    }
}
