<?php
include ('./functions/kasirFunctions.php');
if (!isset($_SESSION['auth'])) {
  redirect('./login.php', "Login to continue");
}
// else if ($_SESSION['role_as'] != 0) {
//   // Selain kasir tidak bisa masuk kedalam halaman cashier
//   redirect('./admin/index.php', 'You\'re not cashier');
// }