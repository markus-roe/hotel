<?php 

require_once  getcwd()."/core/model.php";
// require_once  getcwd()."/config.php";

class BookingModel extends Model
{
    public int $bookingId;


    public function __construct()
    {
        parent::__construct();
    }


    public function getBookings()
    {
        $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name FROM bookings b
        JOIN booking_status bs ON b.statusId = bs.statusId;";

        $bookings = parent::executeQuery($query);

        console_log($bookings);

        return $bookings;
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