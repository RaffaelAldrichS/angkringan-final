<?php

include "../config/dbcon.php";

function redirect($url, $message)
{
  $_SESSION['message'] = $message;
  header("Location: " . $url);
}
function getAllUsers()
{
  global $conn;
  $query = "SELECT * FROM users";
  return mysqli_query($conn, $query);
}

