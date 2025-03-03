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



$sql = "INSERT INTO rooms(room_id, room_number, room_type, price_per_night, availability) VALUES ('$room_id', '$room_number', '$room_type', '$price_per_night', '$availability')";

if($conn->query($sql) === TRUE){
    echo "New record created successfully";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();





?>