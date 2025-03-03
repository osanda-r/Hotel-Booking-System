<?php
require_once 'db_connection.php'; // Path adjusted to match the file location

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guest_id = $_POST['guest_id'];
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];

    // Create booking
    $booking_query = "INSERT INTO bookings (guest_id, room_id, check_in_date, check_out_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($booking_query);
    $stmt->bind_param("iiss", $guest_id, $room_id, $check_in_date, $check_out_date);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Book a Room</h1>
    <form method="POST">
        <label>Guest ID:</label>
        <input type="number" name="guest_id" required>

        <label>Room ID:</label>
        <input type="number" name="room_id" required>

        <label>Check-In Date:</label>
        <input type="date" name="check_in_date" required>
            
        <label>Check-Out Date:</label>
        <input type="date" name="check_out_date" required>

        <button type="submit">Book Room</button>
    </form>
</div>
</body>
</html>
