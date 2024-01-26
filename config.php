<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "5yndromedobi_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
global $conn;

//check connection
if($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

?>