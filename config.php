<?php
$conn = new mysqli('localhost', 'root', '', 'uas_web');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>