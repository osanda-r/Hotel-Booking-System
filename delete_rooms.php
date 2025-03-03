<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_booking";
$room_id = $_POST['room_id'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}



$sql = "DELETE FROM rooms WHERE room_id='$room_id'";

if($conn->query($sql) === TRUE){
    echo "The record deleted successfully";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();


?>