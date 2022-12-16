<?php
require_once getcwd()."/public/views/Pages/userPage.php";

class UserBookingdetailsPage extends UserPage
{
    function __construct(?array $bookingsData)
    {
        parent::__construct();

        if ($bookingsData != null)
        {
            $bookingCards = $this->createBookingCards($bookingsData);
            $this->changeContent($bookingCards);
        }

    }

    private function createBookingCards(array $bookingsData)
    {
        $this->getTemplate("/Content/bookingCard");
        $cardCollection = new Component();

        foreach($bookingsData as $data)
        {
            $params =
            [
                "userId" => @$data["userId"],
                "firstname"=>$data["firstname"],
                "surname"=>$data["surname"],
                "startDate"=>$data["startDate"],
                "endDate"=>$data["endDate"],
                $data["status"] => "selected",
                "services" => ""
            ];
    
            foreach($data["services"] as $service)
            {
               $params["services"] .= "<li>".$service."</li>";
            }

            $card = new BookingCard();
            $card->parse($params);

            array_push($cardCollection->templates, $card);
        }

        return $cardCollection;
    }
}