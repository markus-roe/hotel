<?php
require_once getcwd()."/public/views/Pages/adminPage.php";

class AdminBookingdetailsPage extends AdminPage
{
    function __construct()
    {
        parent::__construct();


    }


    public function createBookingCards(array $bookingsData)
    {
        if (count($bookingsData) <= 0) return 0;

        $this->getTemplate("/Content/bookingCard");
        $cardCollection = new Component();

        foreach ($bookingsData as $data) {
                $params =
                    [
                        "userId" => @$data["userId"],
                        "bookingId" => $data["bookingId"],
                        "firstname" => $data["firstname"],
                        "surname" => $data["surname"],
                        "startDate" => $data["startDate"],
                        "endDate" => $data["endDate"],
                        "roomId" => $data["roomId"],
                        $data["bookingStatus"] => "selected",
                        "services" => ""
                    ];

                $card = new BookingCard();
                $card->parse($params);

                array_push($cardCollection->templates, $card);
        }


        $this->changeContent($cardCollection);
    }
}