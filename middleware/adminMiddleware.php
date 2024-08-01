<?php

include ('../functions/adminFunctions.php');

if (isset($_SESSION['auth'])) {
  if ($_SESSION['role_as'] != 1) {
    // $_SESSION['message'] = 'You\'re not authorized to access this page';
    // header('Location: ../index.php');
    redirect('../index.php', 'You\'re not authorized to access this page');
  }
} else {
  // $_SESSION['message'] = 'Login to continue';
  // header('Location: ../login.php');
  redirect('../login.php', 'Login to continue');
}
