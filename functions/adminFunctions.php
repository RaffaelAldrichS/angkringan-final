<?php

include "../config/dbcon.php";

function redirect($url, $message)
{
  $_SESSION['message'] = $message;
  header("Location: " . $url);
}
function getAllItems($table)
{
  global $conn;
  $query = "SELECT * FROM $table";
  return mysqli_query($conn, $query);
}

function getUsernameById($userId)
{
  global $conn;
  $query = "SELECT * FROM users WHERE id = '$userId'";
  return mysqli_query($conn, $query);
}
