<?php
$conn = new mysqli('localhost', 'root', '', 'room_reservation');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $room_id = $_POST['room_id'];
  $user_name = $_POST['user_name'];
  $user_company = $_POST['user_company'];
  $user_contact = $_POST['user_contact'];
  $user_email = $_POST['user_email'];
  $booking_date = $_POST['booking_date'];
  $booking_time = trim($_POST['booking_time']);
  $guest_count = $_POST['guest_count'];

  // Basic validation
  if (!$room_id || !$user_name || !$booking_date || !$booking_time) {
    // echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
    exit;
  }

  // Check for duplicate
  $check = $conn->query("SELECT COUNT(*) AS count FROM reservations WHERE room_id = $room_id AND booking_date = '$booking_date' AND booking_time = '$booking_time'");
  $row = $check->fetch_assoc();
  if ($row['count'] > 0) {
    echo json_encode(['status' => 'error', 'message' => 'This room is already booked for the selected date and time.']);
    exit;
  }

  // Insert booking
  $conn->query("INSERT INTO reservations (room_id, user_name, user_company, user_contact, user_email, booking_date, booking_time, guest_count)
    VALUES ($room_id, '$user_name', '$user_company', '$user_contact', '$user_email', '$booking_date', '$booking_time', $guest_count)");

  echo json_encode(['status' => 'success', 'message' => 'Booking confirmed.']);
}
