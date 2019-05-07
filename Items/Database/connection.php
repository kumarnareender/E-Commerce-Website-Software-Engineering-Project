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

function runQuery($query) {
		$result = mysqli_query($this->connection,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}

?>



