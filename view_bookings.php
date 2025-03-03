<?php
require_once 'db_connection.php'; // Path adjusted to match the file location

// Fetch all bookings
$booking_query = "SELECT b.booking_id, b.guest_id, b.room_id, b.check_in_date, b.check_out_date, 
                        g.name AS guest_name, r.room_number 
                  FROM bookings b 
                  JOIN guests g ON b.guest_id = g.guest_id 
                  JOIN rooms r ON b.room_id = r.room_id";
$result = $conn->query($booking_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="view_styles.css">
</head>
<body>

<h1>Booking Details</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Guest Name</th>
                <th>Room Number</th>
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['guest_name']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['check_in_date']; ?></td>
                    <td><?php echo $row['check_out_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No bookings found.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>
