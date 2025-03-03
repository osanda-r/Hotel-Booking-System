<?php
require_once 'db_connection.php'; // Adjusted path to match the actual file location

// Fetch all guests from the database
$sql = "SELECT * FROM guests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Guest Details</title>

    <link rel="stylesheet" href="view_styles.css"> 
</head>
<body>
    <h1>Guest Details</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Guest ID</th>
                <th>Name</th>
                <th>Contact Info</th>
                <th>Email</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['guest_id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['contact_info'] ?></td>
                    <td><?= $row['email'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No guest records found.</p>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
