<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_booking";
$guest_id = $_POST['guest_id'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}



$sql = "DELETE FROM guests WHERE guest_id='$guest_id'";

if($conn->query($sql) === TRUE){
    echo "The record deleted successfully";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();


?>