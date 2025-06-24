<?php
$conn = mysqli_connect("localhost", "root", "", "kilimotz");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
