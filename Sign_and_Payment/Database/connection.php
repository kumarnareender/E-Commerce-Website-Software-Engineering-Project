<?php
$servername = "localhost";
$username = "root";
$password = "";
$dname = "shopping_database";

// Create connection
$conn = mysqli_connect($servername, $username,$password,$dname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>



