<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_booking";
$room_id = $_POST['room_id'];
$room_number = $_POST['room_number'];
$room_type = $_POST['room_type'];
$price_per_night = $_POST['price_per_night'];
$availability = $_POST['availability'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


echo "Search successfully" . "<br>";
$sql = "SELECT * FROM rooms WHERE room_id='$room_id'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "The record already exists";
    while($row = $result->fetch_assoc()){
        echo "Room ID: " . $row["room_id"] . "<br>";
        echo "Room number: " . $row["room_number"] . "<br>";
        echo "Room type: " . $row["room_type"] . "<br>";
        echo "Price per night: " . $row["price_per_night"] . "<br>";
        echo "Availability: " . $row["availability"] . "<br>";
    
    }
} else {
    echo "0 results";
}

$conn->close();


?>
