<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "posigraph_socialplexus";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $db);


// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>