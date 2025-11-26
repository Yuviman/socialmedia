<?php
$host = "localhost";
$user = "root"; // your MySQL username
$pass = ""; // your MySQL password
$db = "socialmedia";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

session_start();
?>
