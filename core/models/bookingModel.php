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
        if (!$this->roomIsVacant($startDate, $endDate, intval($roomId))) {
            return 0;
        }

        $query = "INSERT INTO bookings (userId, roomId, startDate, endDate) VALUES (?, ?, ?, ?)";
        $bookingId = parent::executeQuery($query, "iiss", [$userId, $roomId, $startDate, $endDate]);

        // create Receipt, insert receiptId into bookings

        return $bookingId;
    }

    public function calculatePrice($bookingId, $roomId)
    {
        $pricePerNight = $this->getPricePerNightByRoomId($roomId);
        $numberOfNights = $this->countNightsByBookingId($bookingId);

        $price = abs($pricePerNight * $numberOfNights);

        return $price;
    }

    public function createReceipt($price)
    {

        $query =
            "INSERT INTO receipt (price) VALUES(?);";

        $stmt = self::$connection->prepare($query);
        $stmt->bind_param("d", $price);
        $stmt->execute();
        $receiptId = self::$connection->insert_id;

        // create Receipt, insert receiptId into bookings

        return $receiptId;
    }

    public function countNightsByBookingId($bookingId): int
    {
        $query =
            "SELECT DATEDIFF(
                (SELECT startDate FROM bookings WHERE bookingId = ?),
                (SELECT endDate FROM bookings WHERE bookingId = ?)
            ) AS res;";

        $stm = self::$connection->prepare($query);

        $result = $this->executeQuery($query, "ii", [$bookingId, $bookingId]);

        $result = $result[0]["res"] * (-1);

        return $result;
    }

    // public function createReceiptByB

    public function getPricePerNightByRoomId($roomId)
    {
        $stmt =
            "SELECT price FROM rooms
        WHERE roomId = ?";

        $result = parent::executeQuery($stmt, "i", [$roomId]);
        $pricePerNight = $result[0]["price"];

        return $pricePerNight;
    }

    public function getAllBookings()
    {
        $query =
            "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name, bs.name as bookingStatus, u.firstname, u.surname
            FROM bookings b
            JOIN booking_status bs ON b.statusId = bs.statusId
            JOIN users u ON u.userId=b.userId";

        $bookings = parent::executeQuery($query);

        return $bookings;
    }

    public function getBookingByUserId($userId)
    {
        $query =
            "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name, bs.name as bookingStatus, u.firstname, u.surname
        FROM bookings b
        JOIN booking_status bs ON b.statusId = bs.statusId
        JOIN users u ON u.userId=b.userId
        WHERE b.userId = ?;";

        $stmt = self::$connection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookings = $result->fetch_all(MYSQLI_ASSOC);

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
    public function updateBookingStatusById($bookingId, $statusName)
    {
        $query = 
        "UPDATE bookings SET statusId bs = 
        (SELECT bs.statusId FROM booking_status
        WHERE bs.name = ?)
        WHERE bookingId = ?";

        $booking = parent::executeQuery($query, "si", [$statusName, $bookingId]);

        return $booking;
    }

    public function updateBookingById($bookingId, $startDate, $endDate, $bookingStatus, $price, $roomId)
    {
        $query =
        "UPDATE bookings
        SET startdate = ?, SET endDate = ?, SET price = ?, 
        WHERE bookingId = ?;";

    $booking = parent::executeQuery($query, "ssi", [$startDate, $endDate, $price]);

    $this->updateBookingStatusById($bookingId, $bookingStatus);

    return true;
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
