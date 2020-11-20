(function($){
  'use strict';

  $(function(){

    /**
     * LOCAL VARIABLES
     */
    var url = $('input#base_url').val() + 'settings/user';

    /**
     * ADD USER
     */
    $('#form-user-add').submit(function( event ) {

      // Prevent form from submition
      event.preventDefault();

      // Get field values
      var data  = {
        user_fname  : $('input[name="user_fname"]').val(),
        user_email  : $('input[name="user_email"]').val(),
        user_phone  : $('input[name="user_phone"]').val(),
        user_name   : $('input[name="user_name"]').val(),
        user_pass   : $('input[name="user_pass"]').val(),
        user_level  : $('select[name="user_level"]').val(),
        user_add    : 'Add User',
      }

      // Check if the password matches
      if ( $('input[name="user_pass"]').val() != $('input[name="user_pcon"]').val() ) {

        // Show error message
        showErrorToast( 'Password does not match.' );
      } else {
        
        // Parameter to check
        var check = {
          value      : $('input[name="user_name"]').val(),
          user_check : 'Check',
        }

        // Check username
        $.post( url, check ).done( function( res ) {

          // Check response
          if ( res.msg == 'none' ) {
            
            // Add User
            // Check for empty values
            if ( data_checker( data ) ) {
            
              // Send data to the server
              $.post( url, data ).fail( function() {
      
                // Shwo error message
                showErrorToast( 'Error executing command.' );

              } ).done( function( data ) {
      
                // Show success message
                showSuccessToast( 'User successfully added.' );
      
                // Re-populate table
                user_table_draw( data );
      
                // Reset form
                $('#form-user-add').trigger('reset');
      
                // Reset input icons
                input_icon_reset();
      
              } );
            }
          } else {
            showWarningToast( 'Username already exist.' );
          }
        }); 
      }
    });

    /**
     * UPDATE USER
     */
    $('#form-user-update').submit(function( event ) {

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
        u_user_status : $('select[name="edit_user_status"]').val(),
        u_user_level  : $('select[name="edit_user_level"]').val(),
        u_user_add    : '',
        user_update   : 'Update User',
      }

      // Check if the password matches
      if ( $('input[name="edit_user_pass"]').val() != $('input[name="edit_user_pcon"]').val() ) {

        // Show error message
        showErrorToast( 'Password does not match.' );
      } else {
        if ( data_checker( data ) ) {
          
          // Send data to the server
          $.post( url, data ).fail( function(responseText) {

            // Shwo error message
            showErrorToast( 'Error executing command.' );
            console.log(responseText);

          } ).done( function( data ) {

            // Show success message
            showSuccessToast( 'User successfully added.' );

            // Re-populate table
            user_table_draw( data );

            // Reset form
            $('#form-user-update').trigger('reset');

            // Reset input icons
            input_icon_reset();

            // Show modal
            $( '#user_modal' ).modal( 'hide' );

          } );
        }
      }
    });

    /**
     * DELETE USER 
     */
    $('input[name="edit_user_delete"]').on('click', function() {

      // Show confirmation
      swal({
        title: "Are you sure?",
        text: "This action cannot be reverted.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
      })
      .then(( value ) => {

        // Fire the callback
        if ( value ) {
          
          // Get field values
          var data  = {
            user_id     : $(this).attr('id'),
            user_delete : 'delete',
          }

          if ( data_checker( data ) ) {
            
            // Send data to the server
            $.post( url, data ).done( function( data ) {

              // Hide modal
              if ( $( '#user_modal' ).modal( 'hide' ) ) {

                // Re-populate table
                if ( user_table_draw( data ) ) {

                  // Show success message       
                  swal("User successfully deleted.", {
                    icon: "success",
                  });
                }
              }             
            } );
          }

        } else {
          swal.close();
        }
      });
    });

    /**
     * TABLE DRAW
     */
    function user_table_draw( data ) {

      // Define the table to be updated
      var table = $('#user-table').DataTable();

      // Clear the table
      table.clear();

      // Map table values
      var trdata = data.map( function( val ) {
        var tdata  = [];

        // Push data to the array
        tdata.push( '<img class="profile-image rounded-circle img-sm" src="'+ $('input#base_url').val() +'bh-uploads/'+ val.user_photo +'"> '+ capitalize( val.user_fname ) );
        tdata.push( val.user_phone );
        tdata.push( '<span class="text-warning">' + capitalize( val.login_level ) + '</span>' );
        tdata.push( '<span class="text-info">' + capitalize( val.login_name ) + '</span>' );
        tdata.push( '<span class="user-details" u-id="'+ val.user_id +'" u-fname="'+ capitalize( val.user_fname ) +'" u-phone="'+ val.user_phone +'" u-email="'+ val.user_email +'" u-name="'+ capitalize( val.login_name ) +'" u-status="'+ capitalize( val.user_status ) +'" u-level="'+ capitalize( val.login_level ) +'"  ><i class="mdi mdi-eye mdi-18px"></i> View</span>' );
        
        return tdata;
      } );

      // Add data to the table
      table.rows.add( trdata ).draw();

      // Re-delegate click function on user-details class
      $('body').delegate('.user-details', 'click', function() {
        user_view_details( $(this) );
      });

      return true;
    }

    /**
     * USER DETAILS CLICK
     */
    $('.user-details').on( 'click', function() {
      user_view_details( $(this) );
    } );

    /**
     * HANDLES VALUES TO VIEW
     */
    function user_view_details( obj ) {
      
      // Assign values to modal input
      $('input[name="edit_user_id"]').val( obj.attr('u-id') );
      $('input[name="edit_user_fname"]').val( obj.attr('u-fname') );
      $('input[name="edit_user_email"]').val( obj.attr('u-email') );
      $('input[name="edit_user_phone"]').val( obj.attr('u-phone') );
      $('input[name="edit_user_name"]').val( obj.attr('u-name') );
      $('input[name="edit_user_delete"]').attr( 'id', obj.attr('u-id') );

      $('select[name="edit_user_status"]:first').val( obj.attr('u-status') );
      $('select[name="edit_user_level"]:first').val( obj.attr('u-level') );

      // Hide delete button if it is super admin
      if ( parseInt( obj.attr('u-id') ) == 1 ) {
        $('input[name="edit_user_delete"]').css( 'display', 'none' );
      } else {
        $('input[name="edit_user_delete"]').css( 'display', 'block' );
      }

      // Show modal
      $( '#user_modal' ).modal( 'show' );

      // Input icons
      input_icon_reset();

      // Initialize select2
      $('.select2').select2({width: 'calc(100% - 65px)'});
    }

    /**
     * DELEGAT EVENT TO PAGINATION
     */
    $('.paginate_button').on('click', function() {
      $('body').delegate('.user-details', 'click', function() {
        user_view_details( $(this) );
      });
    });

  });
})(jQuery);
