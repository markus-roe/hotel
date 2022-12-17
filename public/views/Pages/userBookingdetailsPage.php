<?php
require_once getcwd() . "/public/views/Pages/userPage.php";

class UserBookingdetailsPage extends UserPage
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
                        "firstname" => $data["firstname"],
                        "surname" => $data["surname"],
                        "startDate" => $data["startDate"],
                        "endDate" => $data["endDate"],
                        "roomId" => $data["roomId"],
                        $data["bookingStatus"] => "selected",
                        "services" => ""
                    ];

                // foreach ($data["services"] as $service) {
                //     $params["services"] .= "<li>" . $service . "</li>";
                // }

                $card = new BookingCard();
                $card->parse($params);

                array_push($cardCollection->templates, $card);
        }


        $this->changeContent($cardCollection);
    }
}
