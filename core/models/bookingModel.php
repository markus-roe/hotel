<?php

require_once  getcwd() . "/core/model.php";
// require_once  getcwd()."/config.php";

class BookingModel extends Model
{
    public int $bookingId;


    public function __construct()
    {
        parent::__construct();
    }

    // >>>>> BOOKINGS <<<<<

    protected function roomIsVacant($startDate, $endDate, $roomId)
    {
        $query =
        "SELECT * FROM bookings
        WHERE roomId = ? AND
        (? BETWEEN startDate AND endDate) OR
        (? BETWEEN startDate AND endDate);";

        $roomIsVacant = parent::executeQuery($query, "iss", [$roomId, $startDate, $endDate]);
        $isVacantCount = count($roomIsVacant) > 0 ? false : true;

        return $isVacantCount;
    }

    public function createBooking($userId, $roomId, $startDate, $endDate)
    {
        if (!$this->roomIsVacant($startDate, $endDate, intval($roomId)))
        {
            return 0;
        }

        $query = "INSERT INTO bookings (userId, roomId, startDate, endDate) VALUES (?, ?, ?, ?)";
        $bookingId = parent::executeQuery($query, "iiss", [$userId, $roomId, $startDate, $endDate]);

        return $bookingId;
    }

    public function getAllBookings()
    {
        $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name, bs.name as bookingStatus FROM bookings b
    JOIN booking_status bs ON b.statusId = bs.statusId;";

        $bookings = parent::executeQuery($query);

        return $bookings;
    }

    public function getBookingById($bookingId)
    {
        $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name, bs.name as bookingStatus FROM bookings b
    JOIN booking_status bs ON b.statusId = bs.statusId
    WHERE b.bookingId = ?;";

        $bookings = parent::executeQuery($query, "i", [$bookingId]);

        return $bookings;
    }

    public function getBookingsByUserId($userId)
    {
        $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name FROM bookings b
    JOIN booking_status bs ON b.statusId = bs.statusId
    WHERE b.userId = ?;";

        $bookings = parent::executeQuery($query, "i", [$userId]);

        return $bookings;
    }

    //? EVTL alternative überlegen -> updateBookingsStatus(1,1) ist nicht sehr intuitiv..
    public function updateBookingStatus($bookingId, $statusId)
    {
        $query = "UPDATE bookings SET statusId = ? WHERE bookingId = ?";

        $booking = parent::executeQuery($query, "ii", [$statusId, $bookingId]);

        return $booking;
    }

    public function updateBookingById($bookingId)
    {
        $query = "UPDATE bookings SET statusId = ? WHERE bookingId = ?";

        $booking = parent::executeQuery($query, "ii", [$statusId, $bookingId]);

        return $booking;
    }

    //? EVTL alternative überlegen -> updateBookingsStatus(1,1) ist nicht sehr intuitiv..
    public function deleteBooking($bookingId)
    {
        $query = "DELETE from bookings WHERE bookingId = ?";

        $booking = parent::executeQuery($query, "i", [$bookingId]);

        return $booking;
    }

    // >>>>> ROOMS <<<<<

    // * Rooms ---> roomModel? oder lassen wir es das bookingModel machen?

    public function getAllRooms()
    {
        $query = "SELECT r.*, p.picturePath FROM rooms r
    JOIN pictures p ON r.pictureId = p.pictureId";

        $rooms = parent::executeQuery($query);

        return $rooms;
    }

    public function getRoomById($roomId)
    {
        $query = "SELECT r.*, p.picturePath FROM rooms r
    JOIN pictures p ON r.pictureId = p.pictureId
    WHERE r.roomId = ?;";

        $room = parent::executeQuery($query, "i", [$roomId]);

        return $room[0];
    }
}
