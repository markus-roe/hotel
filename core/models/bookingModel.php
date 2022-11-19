<?php 

require_once  getcwd()."/core/model.php";
require_once  getcwd()."/config.php";

class Booking extends Model
{
    public int $bookingId;


    public function __construct()
    {
        parent::__construct();
    }


    public function getBookings()
    {
    
    }

    public function getBookingByUserId()
    {

    }

    public function getServicesByBookingId()
    {

    }

    public function createBooking()
    {

    }

    

}