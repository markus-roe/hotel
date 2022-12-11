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

        return $bookings;
    }

    public function getBookingById($bookingId)
    {
        $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name FROM bookings b
        JOIN booking_status bs ON b.statusId = bs.statusId
        WHERE b.bookingId = ?;";

        $bookings = parent::executeQuery($query, "i", [$bookingId]);

        return $bookings;
    }

    public function getBookingByUserId($userId)
    {
        $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name FROM bookings b
        JOIN booking_status bs ON b.statusId = bs.statusId
        WHERE b.userId = ?;";

        $bookings = parent::executeQuery($query, "i", [$userId]);

        return $bookings;
    }

    public function getServicesByBookingId()
    {

    }

    public function createBooking()
    {

    }

    

}