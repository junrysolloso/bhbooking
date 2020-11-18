(function ($) {
  'use strict';
  $(function () {

    // Confirm booking
    $('.confirm-booking').on('click', function(){
      swal({
        title: "Are you sure?",
        text: "Booking confirmation message.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
      })
      .then((callback) => {
        if (callback) {
          swal("Booking successfully confirm.", {
            icon: "success",
          });
        } else {
          swal.close();
        }
      });
    })
   
  });
})(jQuery)