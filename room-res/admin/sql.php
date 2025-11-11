<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'room_reservation';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM reservations ORDER BY booking_date, booking_time ASC";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . $conn->error);
}
?>