<?php
require_once  getcwd() . "/core/controller.php";

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

function preview_mock()
{
    return [
        [
          "room-name" => "24K Suite",
          "room-price" => "420.69",
          "picturePath" => "./public/images/hotelroom1.jpg",
          "room-href" => "./booking/room/1/index"
        ],
        [
          "room-name" => "420K Suite",
          "room-price" => "420.69",
          "picturePath" => "./public/images/hotelroom3.jpg"
        ],
    ];
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
        $this->getTemplate("/Pages/roomsPreviewPage");
        $page = new RoomsPreviewPage(preview_mock());
        $page->parse();
        $page->render();

    }

    public function renderRoomPage()
    {
        $this->getTemplate("/Pages/roomPage");
        $page = new RoomPage();
        $page->parse();
        $page->render();
    }


    public function renderOverviewPage($params = null)
    {
        // $bookingData = $this->bookingModel->getBookingById($this->request["bookingid"]);
        $bookingData = booking_mock();

        if (count($bookingData) <= 0) {
            $this->getTemplate("/Components/page");
            $page = new Page();
            $page->parse(["content-title" => "Noch keine Buchungen vorhanden!"]);
            $page->render();

            return 1;
        }

        $this->getTemplate("/Pages/bookingPage");
        $this->getTemplate("/Content/bookingCard");
        $bookingCardArr = [];

        $bookingPage = new BookingPage($bookingData);
        $bookingPage->parse();
        $bookingPage->render();
    }
}
