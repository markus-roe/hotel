<?php
require_once  getcwd() . "/core/controller.php";
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

class BookingController extends Controller
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        parent::indexAction();
    }

    public function renderRoomsPage()
    {
        $bookingModel = new BookingModel();

        $this->getTemplate("/Pages/roomsPreviewPage");
        $page = new RoomsPreviewPage($bookingModel->getAllRooms());
        $page->parse($this->userData);
        $page->render();
    }

    public function renderRoomPage()
    {
        $bookingModel = new BookingModel();

        $this->getTemplate("/Pages/roomPage");

        $currentRoom = $bookingModel->getRoomById($this->request["id"]);
        $page = new RoomPage($currentRoom);
        $page->parse($this->userData);
        $page->render();
    }


    public function renderOverviewPage($params = null)
    {
        $bookingData = $this->bookingModel->getBookingById($this->request["id"]);
        // $bookingData = booking_mock();

        if (count($bookingData) <= 0) {
            $this->getTemplate("/Components/page");
            $page = new Page();
            $noBookings = ["content-title" => "Noch keine Buchungen vorhanden!"];
            $data = array_merge($noBookings, $this->userData);

            $page->parse($data);
            $page->render();

            return 1;
        }

        $this->getTemplate("/Pages/bookingPage");
        $this->getTemplate("/Content/bookingCard");
        $bookingCardArr = [];

        $bookingPage = new BookingPage($bookingData);
        $bookingPage->parse($this->userData);
        $bookingPage->render();
    }
}
