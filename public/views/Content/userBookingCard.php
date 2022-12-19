<?php
require_once getcwd()."/core/component.php";

class UserBookingCard extends Component
{
    function __construct()
    {
        parent::__construct();

        $params = 
        [
            "firstname",
            "surname",
            "startDate",
            "endDate",
            "confirmed",
            "new",
            "storno",
            "services",
            "status",
            "price"
        ];
        
        $bookingCardTemplate = new Template("guestBookingCardTemplate", $params);

        $this->templates =
        [
            "bookingCard" => $bookingCardTemplate
        ];
    }
}