<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "wedangan";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}