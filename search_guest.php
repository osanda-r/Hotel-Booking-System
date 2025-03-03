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


echo "Search successfully" . "<br>";
$sql = "SELECT * FROM guests WHERE guest_id='$guest_id'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "The record already exists";
    while($row = $result->fetch_assoc()){
        echo "Guest ID : " . $row["guest_id"] . "<br>";
        echo "Name : " . $row["name"] . "<br>";
        echo "Contact : " . $row["contact_info"] . "<br>";
        echo "Email : " . $row["email"] . "<br>";
    
    }
} else {
    echo "0 results";
}

$conn->close();


?>
