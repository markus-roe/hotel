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


    public function renderBookingsPage($params = null)
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
