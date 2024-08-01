<?php

session_start();
include '../functions/adminFunctions.php';
if (isset($_POST['login_btn'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $check_username = "SELECT * FROM users WHERE username = '$username'";
  $check_username_run = mysqli_query($conn, $check_username);

  if (mysqli_num_rows($check_username_run) > 0) {
    $userdata = mysqli_fetch_array($check_username_run);
    $db_password = $userdata["password"];

    if (password_verify($password, $db_password)) {
      $_SESSION["auth"] = true;

      $_SESSION['auth_user'] = [
        'user_id' => $userdata['id'],
        'username' => $userdata['username'],
        'role_as' => $userdata['role_as'],
        'cabang' => 'gedongan'
      ];

      $_SESSION['role_as'] = $userdata['role_as'];
      if ($userdata['role_as'] == 1) {
        redirect('../admin/index.php', "Welcome owner");
      } else {
        redirect('../index.php', 'Logged In Successfully');
      }
    } else {
      redirect('../login.php', 'Wrong Password');
    }
  } else {
    redirect('../login.php', 'Username does\'nt  exist');
  }
}