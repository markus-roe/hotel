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

        $this->getTemplate("/Content/guestBookingCard");
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
                        "price" => $data["price"],
                        $data["bookingStatus"] => "selected",
                        "services" => ""
                    ];
                
                if (array_key_exists("services", $data))
                {
                    foreach ($data["services"] as $service) {
                        $params["services"] .= "<li>" . $service["name"] . "</li>";
                    }

                }


                $card = new UserBookingCard();
                $card->parse($params);

                array_push($cardCollection->templates, $card);
        }


        $this->changeContent($cardCollection);
    }
}
