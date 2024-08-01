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
});
