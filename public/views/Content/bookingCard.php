<?php
require_once getcwd()."/core/component.php";

class BookingCard extends Component
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
            "price",
            "date"
        ];
        
        $bookingCardTemplate = new Template("bookingCardTemplate", $params);

        $this->templates =
        [
            "bookingCard" => $bookingCardTemplate
        ];
    }
}