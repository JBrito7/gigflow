<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'event_manager';

// Create connection with database
$conn = new mysqli($host, $user, $password, $database);

// Error message if connection fails
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}