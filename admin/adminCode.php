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
} else if (isset($_POST['update_btn'])) {
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
} else if (isset($_POST['delete_btn'])) {
  $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

  $delete_query = "DELETE FROM users WHERE id = '$user_id'";
  $delete_query_run = mysqli_query($conn, $delete_query);

  if ($delete_query_run) {
    echo 200;
  } else {
    echo 500;
  }
} else if (isset($_POST['addProduct_btn'])) {
  $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $stock = mysqli_real_escape_string($conn, isset($_POST['stock']) ? $_POST['stock'] : '0');
  $created_by = mysqli_real_escape_string($conn, $_POST['created_by']);
  $is_approved = mysqli_real_escape_string($conn, $_POST['is_approved']);

  $check_product = "SELECT * FROM products WHERE product_name = '$product_name'";
  $check_product_run = mysqli_query($conn, $check_product);

  if (mysqli_num_rows($check_product_run) > 0) {
    header('Location: ../admin/index.php?target=products');
    exit();
  } else {
    $insert_query = "INSERT INTO products (product_name, price, stock, created_by, is_approved) VALUES ('$product_name','$price','$stock','$created_by', '$is_approved')";
    $insert_query_run = mysqli_query($conn, $insert_query);

    if ($insert_query_run) {
      header('Location: ../admin/index.php?target=products');
    } else {
      header('Location: ../admin/index.php?target=products');
    }
  }
} else if (isset($_POST['change_active'])) {
  $productId = $_POST['product_id'];
  $isApproved = $_POST['is_approved'];

  // Log input untuk memastikan data dikirim dengan benar
  error_log("Product ID: $productId, isApproved: $isApproved");

  // Update status persetujuan produk
  $update_query = "UPDATE products SET is_approved = '$isApproved' WHERE id = '$productId'";
  $update_query_run = mysqli_query($conn, $update_query);

  // Gunakan mysqli_affected_rows untuk cek apakah ada perubahan yang dilakukan
  if (mysqli_affected_rows($conn) > 0) {
    echo 200;
  } else {
    echo 500;
  }
}
