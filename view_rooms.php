<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all rooms
$sql = "SELECT room_id, room_number, room_type, price_per_night, availability FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Rooms</title>
    <link rel="stylesheet" href="view_styles.css">
</head>
<body>

<h1>Room Details</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Price per Night</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['room_id']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td>$<?php echo number_format($row['price_per_night'], 2); ?></td>
                    <td class="<?php echo $row['availability'] == 'available' ? 'available' : 'not-available'; ?>">
                        <?php echo ucfirst($row['availability']); ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No rooms available.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>
