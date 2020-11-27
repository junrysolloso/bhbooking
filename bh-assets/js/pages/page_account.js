(function($){
  'use strict';

  $(function(){

     /**
     * LOCAL VARIABLES
     */
    var url = base_url + 'settings/user';

    $('#account-edit').on('click', function(){
      $('#account_modal').modal('show');
    });

    /**
     * UPDATE USER
     */
    $('#form-account-update').submit(function( event ) {

      // Prevent form from submition
      event.preventDefault();

      // Get field values
      var data  = {
        u_user_id     : $('input[name="edit_user_id"]').val(),
        u_user_fname  : $('input[name="edit_user_fname"]').val(),
        u_user_email  : $('input[name="edit_user_email"]').val(),
        u_user_phone  : $('input[name="edit_user_phone"]').val(),
        u_user_name   : $('input[name="edit_user_name"]').val(),
        u_user_pass   : $('input[name="edit_user_pass"]').val(),
        u_user_add    : $('input[name="edit_user_add"]').val(),
        u_user_status : '',
        u_user_level  : 'booker',
        user_update : 'Update User',
      }

      // Check if the password matches
      if ( $('input[name="edit_user_pass"]').val() != $('input[name="edit_user_pcon"]').val() ) {

        // Show error message
        showErrorToast( 'Password does not match.' );
      } else {
        if ( data_checker( data ) ) {
          
          // Send data to the server
          $.post( url, data ).done( function( data ) {

            // Show success message
            swal("User successfully added.", {
              icon: "success",
            });

            // Reset form
            $('#form-account-update').trigger('reset');

            // Set new values
            set_values( data[0] );

            // Show modal
            $( '#account_modal' ).modal( 'hide' );
            
            // Reset input icons
            input_icon_reset();

          } );
        }

        // Reload page
        setTimeout(function(){
          window.location.reload();
        }, 500 );
      }
    });

    /**
     * CANCEL BOOKING EVENT
     */
    $('.cancel-booking').on('click', function(){
      cancel_booking( $(this) );
    });

    /**
     * CANCEL BOOKING
     * 
     * @param {object} obj 
     */
    function cancel_booking( obj ) {
       // Get ids
       var data = {
        c_book_id: obj.attr('b-id'),
        c_room_id: obj.attr('r-id'),
        c_user_id: obj.attr('u-id'),
      }

      // Confirmation
      swal({
        title: "Are you sure?",
        text: "Booking cancellation message.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
      })
      .then((callback) => {
        if (callback) {
          
          // Send request to the server
          $.post( base_url + 'booking/update-status', data ).done(function( data ) {

            // Populate table
            if ( data ) {

              // Show success message
              swal("Booking successfully cancelled.", {
                icon: "warning",
              });

              // Reload page
              setTimeout( function() {
                window.location.reload();
              }, 2000 );
            }
          });
        } else {
          swal.close();
        }
      });
    }

    /**
     * SHOW BOOKING MODAL
     */
    $('#add-booking').on('click', function() {

      // Show modal
      $('#add_new_booking').modal('show');
    });

    /**
     * ADD BOOKING SUBMIT
     */
    $('#form-add-booking').submit( function(event) {
      
      // Prevent form from submision
      event.preventDefault();

      // Get data
      var data = {
        user_id: $('input[name="edit_user_id"]').val(),
        arrival: $('input[name="add_booking"]').val(),
      }

      // Post data
      $.post( base_url + 'booking/book-me', data ).done( function() {
        
        // Show success message
        swal("Booking successfully added.", {
          icon: "warning",
        });

        // Reload page
        setTimeout( function() {
          window.location.reload();
        }, 2000 );

      });
    });

    /**
     * CHANGE INPUT ICON ON KEYUP EVENT
     */
    $( 'input' ).on( 'keyup', function() {
      input_icon( $(this) );
    });

     /**
      * INITIALIZE INPUT MASK
      */
     $( ":input" ).inputmask();

  });

  /**
   * SET NEW VALUES
   */
  function set_values( data ) {
    
    // Fields
    $('input[name="user_id"]').val( data.user_id );
    $('input[name="user_fname"]').val( capitalize( data.user_fname ) );
    $('input[name="user_email"]').val( data.user_email );
    $('input[name="user_phone"]').val( data.user_phone );
    $('input[name="user_name"]').val( capitalize( data.login_name ) );
    $('input[name="user_add"]').val( capitalize( data.user_add ) );
    
    // Modal
    $('input[name="edit_user_id"]').val( data.user_id );
    $('input[name="edit_user_fname"]').val( capitalize( data.user_fname ) );
    $('input[name="edit_user_email"]').val( data.user_email );
    $('input[name="edit_user_phone"]').val( data.user_phone );
    $('input[name="edit_user_name"]').val( capitalize( data.login_name ) );
    $('input[name="edit_user_add"]').val( capitalize( data.user_add ) );
  }

  /**
   * TABLE
   */
  $(function () {
    $('#payments-table, #booking-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 10,
      "bLengthChange": false,
    });
  });

  /**
   * RESET ICONS
   */
   input_icon_reset();

})(jQuery);