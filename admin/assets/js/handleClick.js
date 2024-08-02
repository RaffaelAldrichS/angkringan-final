$(document).ready(function () {
  $(document).on("click", ".delete_btn", function (e) {
    e.preventDefault();
    let id = $(this).val();
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          method: "POST",
          url: "adminCode.php",
          data: {
            user_id: id,
            delete_btn: true,
          },
          success: function (response) {
            if (response == 200) {
              swal("Success!", "User deleted successfully", "success");
              $("#users_table").load(location.href + " #users_table");
            } else if (response == 500) {
              swal("Error!", "Something went wrong", "error");
            }
          },
        });
      }
    });
  });
  $(document).on("change", "#product_status", function (e) {
    e.preventDefault();
    let productId = $(this).data("product-id");
    let isApproved = $(this).is(":checked") ? 1 : 0;

    $.ajax({
      method: "POST",
      url: "adminCode.php",
      data: {
        product_id: productId, // Gunakan nama yang sama dengan di PHP
        is_approved: isApproved, // Gunakan nama yang sama dengan di PHP
        change_active: true,
      },
      success: function (response) {
        if (response == 200) {
          swal({
            position: "top-end",
            icon: "success",
            title: "Product status updated",
            showConfirmButton: false,
            timer: 1000,
          });
          $("#users_table").load(location.href + " #users_table");
        } else if (response == 500) {
          swal({
            position: "top-end",
            icon: "error", // Pastikan icon diisi dengan benar
            title: "Product not updated",
            showConfirmButton: false,
            timer: 1000,
          });
        }
      },
    });
  });
});
