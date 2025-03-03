<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_booking";
$guest_id = $_POST['guest_id'];
$name = $_POST['name'];
$contact_info = $_POST['contact_info'];
$email = $_POST['email'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO guests(guest_id, name, contact_info, email) VALUES ('$guest_id', '$name', '$contact_info', '$email')";

if($conn->query($sql) === TRUE){
    echo "New record created successfully";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();





?>