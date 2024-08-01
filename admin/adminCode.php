<?php

include '../functions/adminFunctions.php';
if (isset($_POST['addUser_btn'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

  $check_username = "SELECT * FROM users WHERE username = '$username'";
  $check_username_run = mysqli_query($conn, $check_username);

  if (mysqli_num_rows($check_username_run) > 0) {
    // redirect("index.php?target=users", "Username Already Exist");
    header('Location: ../admin/index.php?target=users');
    exit();
  } else {
    if ($password == $password2) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $insert_query = "INSERT INTO users (username, password, role_as) VALUES ('$username','$hashed_password', '$role') ";
      $insert_query_run = mysqli_query($conn, $insert_query);

      if ($insert_query_run) {
        header('Location: ../admin/index.php?target=users');
        // redirect("index.php?target=users", "Registered Successfully");
      } else {
        header('Location: ../admin/index.php?target=users');
        // redirect("index.php?target=users", "Something Went Wrong");
      }
    } else {
      header('Location: ../admin/index.php?target=users');
      // redirect("index.php?target=users", "Password Do Not Match");
    }
  }
}