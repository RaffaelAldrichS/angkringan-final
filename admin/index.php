<?php

session_start();
include "../middleware/adminMiddleware.php";
include "./includes/header.php";

$url = isset($_GET['target']) ? $_GET['target'] : 'dashboard';

if ($url == 'dashboard') {
  include "./modules/dashboard.php";
} else if ($url == 'users') {
  include "./modules/users.php";
} else if ($url == 'products') {
  include "./modules/products.php";
} else {
  echo 404;
}

include "./includes/footer.php";
