<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "project");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
