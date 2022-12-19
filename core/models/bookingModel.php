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

    public function createBooking($userId, $roomId, $startDate, $endDate, array $serviceIds)
    {
        if (!$this->roomIsVacant($startDate, $endDate, intval($roomId))) {
            return 0;
        }

        $query = "INSERT INTO bookings (userId, roomId, startDate, endDate) VALUES (?, ?, ?, ?)";
        $bookingId = parent::executeQuery($query, "iiss", [$userId, $roomId, $startDate, $endDate]);

        $price = $this->calculatePrice($bookingId, $roomId);
        $receiptId = $this->createReceipt($price);
        $this->setReceiptId($bookingId, $receiptId);

        foreach ($serviceIds as $serviceId) {
            $this->createServiceReceipt($bookingId, $serviceId);
        }

        return $bookingId;
    }

    public function createServiceReceipt($bookingId, $serviceId)
    {
        $query =
            "INSERT INTO serviceReceipt
        (bookingId, serviceId)
        VALUES(?, ?);";

        $result = parent::executeQuery($query, "ii", [$bookingId, $serviceId]);

        return $result;
    }

    public function setReceiptId($bookingId, $receiptId)
    {
        $query =
            "UPDATE bookings
        SET receiptId = ?
        WHERE bookingId = ?";

        $receiptId = parent::executeQuery($query, "ii", [$receiptId, $bookingId]);

        return $receiptId;
    }

    public function updatePrice($receiptId, $price)
    {
        $query =
            "UPDATE receipt
        SET price = ?
        WHERE id = ?";
        $receiptId = parent::executeQuery($query, "di", [$price, $receiptId]);

        return $receiptId;
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
            "SELECT startDate, endDate
        FROM bookings
        WHERE bookingId = ?;";
        // "SELECT DATEDIFF(
        //     (SELECT startDate FROM bookings WHERE bookingId = ?),
        //     (SELECT endDate FROM bookings WHERE bookingId = ?)
        // ) AS res;";

        $stm = self::$connection->prepare($query);

        $result = $this->executeQuery($query, "i", [$bookingId]);

        $startDate = new DateTime($result[0]["startDate"]);
        $endDate = new DateTime($result[0]["endDate"]);

        $numberOfNights = $startDate->diff($endDate)->days;

        return $numberOfNights;
    }

    public function getBookingByBookingId($bookingId)
    {
        $query =
            "SELECT b.userId, b.startDate, b.endDate, b.roomId, r.price, bs.name as bookingStatus, u.firstname, u.surname
        FROM bookings b
        JOIN booking_status bs ON b.statusId = bs.statusId
        JOIN users u ON u.userId=b.userId
        JOIN receipt r ON r.id = b.receiptId
        WHERE bookingId = ?";

        $booking = parent::executeQuery($query, "i", ["$bookingId"]);
        $serviceNames = $this->getServiceNamesByBookingId($bookingId);
        $booking = $this->mergeBookingWithServices($booking, $serviceNames);

        return $booking;
    }

    public function mergeBookingWithServices($booking, $services)
    {
        $booking[0]["services"] = [...$services];
        // $booking = array_merge($booking, $services);
        return $booking;
    }

    public function getPricePerNightByRoomId($roomId)
    {
        $stmt =
            "SELECT price FROM rooms
        WHERE roomId = ?";

        $result = parent::executeQuery($stmt, "i", [$roomId]);
        $pricePerNight = $result[0]["price"];

        return $pricePerNight;
    }

    public function getAllBookingIdsByUserId($userId)
    {
        $query =
            "SELECT bookingId
        FROM bookings
        WHERE userId = ?";

        $bookingIds = parent::executeQuery($query, "i", [$userId]);

        return $bookingIds;
    }

    //TODO get service names
    public function getAllBookings()
    {
        $bookings = [];
        $services = [];
        $bookingIdRows = $this->getAllBookingIds();

        for ($index = 0; $index < count($bookingIdRows); $index++)
        {
            $booking = $this->getBookingByBookingId($bookingIdRows[$index]["bookingId"]);
            array_push($bookings, $booking[0]);
        }


        return $bookings;
    }

    public function getServiceNamesByBookingId($bookingId)
    {
        $services = $this->getServicesByBookingId($bookingId);
        // $serviceNames = array_column($services, "name");

        return $services;
    }

    public function getAllBookingIds()
    {
        $query =
            "SELECT bookingId
        FROM bookings;";

        $stmt = self::$connection->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        $bookingIds = $res->fetch_all(MYSQLI_ASSOC);

        return $bookingIds;
    }


    public function getServicesByBookingId($bookingId)
    {
        $query =
            "SELECT so.name
        FROM serviceoverview so
        JOIN serviceReceipt sr ON sr.id = so.serviceId
        WHERE sr.bookingId = ?";

        $serviceNames = parent::executeQuery($query, "i", [$bookingId]);

        return $serviceNames;
    }
    //TODO get service names
    public function getBookingsByUserId($userId)
    {
        $bookings = [];

        $query =
            "SELECT b.bookingId, r.price, b.userId, b.startDate, b.endDate, b.roomId, bs.name, bs.name as bookingStatus, u.firstname, u.surname
        FROM bookings b
        JOIN booking_status bs ON b.statusId = bs.statusId
        JOIN users u ON u.userId=b.userId
        JOIN receipt r ON r.id = b.receiptId
        WHERE b.userId = ?;";

        $stmt = self::$connection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookings = $result->fetch_all(MYSQLI_ASSOC);

        for ($index = 0; $index < count($bookings); $index++) {
            $serviceNames = $this->getServiceNamesByBookingId($bookings[$index]["bookingId"]);
            $bookings[$index]["services"] = [...$serviceNames];
        }

        return $bookings;
    }

    // public function getBookingsByUserId($userId)
    // {
    //     $query = "SELECT b.bookingId, b.userId, b.startDate, b.endDate, b.roomId, bs.name FROM bookings b
    // JOIN booking_status bs ON b.statusId = bs.statusId
    // WHERE b.userId = ?;";

    //     $bookings = parent::executeQuery($query, "i", [$userId]);

    //     return $bookings;
    // }

    //? EVTL alternative überlegen -> updateBookingsStatus(1,1) ist nicht sehr intuitiv..
    public function updateBookingStatusById($bookingId, $statusName)
    {
        $query =
            "UPDATE bookings SET statusId = 
        (SELECT bs.statusId FROM booking_status
        WHERE bs.name = ?)
         WHERE bookingId = ?";

        $booking = parent::executeQuery($query, "si", [$statusName, $bookingId]);

        return $booking;
    }

    public function updateTimeSpanByBookingId($bookingId, $startDate, $endDate)
    {
        $query =
            "UPDATE bookings
        SET startDate = ?,
        endDate = ?
        WHERE bookingId = ?;";

        $booking = parent::executeQuery($query, "ssi", [$startDate, $endDate, $bookingId]);

        return $booking;
    }

    public function updatePriceByBookingId($bookingId, $price)
    {
        $query =
            "UPDATE bookings
        SET price = ?
        WHERE bookingId = ?;";

        $booking = parent::executeQuery($query, "ii", [$price, $bookingId]);

        return $booking;
    }

    public function updateBookingById($bookingId, $startDate, $endDate, $bookingStatus, $price, $roomId)
    {
        $this->updatePriceByBookingId($bookingId, $price);
        $this->updateBookingStatusById($bookingId, $bookingStatus);
        $this->updateTimeSpanByBookingId($bookingId, $startDate, $endDate);
        $this->updateRoomIdByBookingId($bookingId, $roomId);

        return true;
    }

    public function updateRoomIdByBookingId($bookingId, $roomId)
    {
        $query =
            "UPDATE bookings
        SET roomId = ?
        WHERE bookingId = ?;";

        $booking = parent::executeQuery($query, "ii", [$roomId, $bookingId]);

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
