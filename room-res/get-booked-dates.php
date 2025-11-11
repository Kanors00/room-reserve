<?php
$conn = new mysqli('localhost', 'root', '', 'room_reservation');

$room_id = $_GET['room_id'] ?? 1;
$booked = [];

$result = $conn->query("SELECT booking_date FROM reservations WHERE room_id = $room_id");
while ($row = $result->fetch_assoc()) {
  $booked[] = $row['booking_date'];
}

echo json_encode($booked);
?>