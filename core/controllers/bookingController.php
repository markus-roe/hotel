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
        $currentRoom = $bookingModel->getRoomById($this->request["roomid"]);
        $page = new RoomPage($currentRoom);

        if ($this->request["res"] == "invalid") {
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
            $_POST["startDate"] != "" &&
            $_POST["endDate"] != "";

        if (!$inputIsValid || !$bookingModel->createBooking($this->userData["userId"], $this->request["id"], $_POST["startDate"], $_POST["endDate"], $_POST["services"])) {
            header("Location: " . baseURL . "/booking/room/{$this->request["id"]}?res=invalid");

            return 0;
        }
        // TODO redirect to personal booking page
        header("Location: " . baseURL . "/booking/bookingdetails?res=success");
    }

    public function updateAction()
    {
        $bookingId = $this->request["bookingid"];

        $price = $_POST["price"] ? $_POST["price"] : 0;
        $startDate = $_POST["startDate"] ? $_POST["startDate"] : "2010-10-10";
        $endDate = $_POST["endDate"] ? $_POST["endDate"] : "2010-10-10";;
        $roomId = $_POST["roomId"] ? $_POST["roomId"] : "2";
        $bookingStatus = $_POST["bookingStatus"] ? $_POST["bookingStatus"] : 0;

        $this->bookingModel->updateBookingById($bookingId, $startDate, $endDate, $bookingStatus, $price, $roomId);

        header("Location: ".baseURL. "/admin/bookingdetails");
    }

    // TODO
    public function renderBookingdetailsPage($params = null)
    {
        $bookingPage = new $this->pageName();
        $this->getTemplate("/Content/userBookingCard");
        $bookingModel = new BookingModel();

        $bookingData = $bookingModel->getBookingsByUserId(@$this->userData["userId"]);

        $bookingCardArr = [];
        $pageText = ["content-title" => "Buchungen", "content-body" => "Noch keine Buchungen vorhanden!"];

        if (count($bookingData) <= 0) {
            $pageText["content-body"] = "";
            $bookingPage->parse([...$this->userData, ...$pageText]);
            $bookingPage->render();
            return 0;
        }

        if ($this->request["res"] == "success") {
            $bookingPage->triggerPopup("<span style='font-size:1.5rem'>🥳</span> Buchung erfolgreich!");
        }
        $bookingPage->createBookingCards($bookingData);
        $bookingPage->parse([...$this->userData, ...$bookingCardArr, ...$pageText]);
        $bookingPage->render();


        return 1;
    }
}
