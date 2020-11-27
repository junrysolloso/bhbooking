(function($){
  'use strict';

  $(function(){

    /**
     * LOCAL VARIABLES
     */
    var url = base_url + 'settings/room';

    /**
     * ADD ROOM
     */
    $('#form-room').submit(function( event ) {

      // Prevent form from submition
      event.preventDefault();

      // Get field values
      var data  = {
        room_name  : $('input[name="room_name"]').val(),
        room_equiv : $('input[name="room_equiv"]').val(),
        room_desc  : $('input[name="room_desc"]').val(),
        room_add   : $('input[name="room_submit"]').val(),
        room_rate  : $('input[name="room_rate"]').val(),
      }

        // Parameter to check
        var check = {
          value      : $('input[name="room_name"]').val(),
          room_check : 'Check',
        }
  
        // Check data
        $.post( url, check ).done( function( res ) {
          if ( res.msg == 'none' ) {
            if ( data_checker( data ) ) {
        
              // Send data to the server
              $.post( url, data ).fail( function() {

                // Show error message
                showErrorToast( 'Error executing command.' );

              } ).done( function( data ) {

                // Show success message
                showSuccessToast( 'Room successfully added.' );
      
                // Re-populate table
                room_table_draw( data );
      
                // Reset form
                $('#form-room').trigger('reset');
      
                // Reset input icons
                input_icon_reset();
      
              } );
            }
          } else {
            showWarningToast( 'Room already exist.' );
          }
        });
    });

    /**
     * UPDATE ROOM
     */
    $('#room-update').submit(function( event ) {

      // Prevent form from submition
      event.preventDefault();

      // Get field values
      var data  = {
        room_id    : $('input[name="edit_room_id"]').val(),
        room_name  : $('input[name="edit_room_name"]').val(),
        room_equiv : $('input[name="edit_room_equiv"]').val(),
        room_status: $('select[name="edit_room_status"]').val(),
        room_desc  : $('input[name="edit_room_desc"]').val(),
        room_rate  : $('input[name="edit_room_rate"]').val(),
        room_update: $('input[name="edit_room_submit"]').val(),
      }

      if ( data_checker( data ) ) {

        // Send data to the server
        $.post( url, data ).fail( function() {
          
          // Show error message
          showErrorToast( 'Error executing command.' );

        } ).done( function( data ) {
          
          // Show success message
          showSuccessToast( 'Room successfully updated.' );

          // Re-populate table
          room_table_draw( data );

          // Hide modal
          $( '#room_modal' ).modal( 'hide' );

          // Reset form
          $('#room-update').trigger('reset');

          // Reset input icons
          input_icon_reset();

        } );
      }
    });

    /**
     * DELETE ROOM 
     */
    $('input[name="edit_room_delete"]').on('click', function(){

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
            room_id     : $(this).attr('id'),
            room_delete : 'delete',
          }

          if ( data_checker( data ) ) {
            
            // Send data to the server
            $.post( url, data ).done( function( data ) {

              // Hide modal
              if ( $( '#room_modal' ).modal( 'hide' ) ) {

                // Re-populate table
                if ( room_table_draw( data ) ) {

                  // Show success message       
                  swal("Room successfully deleted.", {
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
    function room_table_draw( data ) {

      // Define the table to be updated
      var table = $('#room-table').DataTable(), count = 1;

      // Clear the table
      table.clear();

      // Map table values
      var trdata = data.map( function( val ) {
        var tdata  = [];

        // Push data to the array
        tdata.push( count );
        tdata.push( capitalize( val.room_name + ' ( '+ val.room_status +' )' ) );
        tdata.push( '<span class="text-info">' + parseInt( val.room_equiv ) + ' Bedroom(s)</span>' );

        if (  val.room_available == 0 ) {

          // Full
          tdata.push( '<span class="text-danger">'+ val.room_available +' Bed(s) Availabe </span>' );
        } else if ( val.room_available == val.room_equiv ) {

          // Empty
          tdata.push( '<span class="text-success">'+ val.room_available +' Bed(s) Availabe </span>' );
        } else {

          // Occupied
          tdata.push( '<span class="text-warning">'+ val.room_available +' Bed(s) Availabe </span>' );
        }

        tdata.push( '<span class="room-details" r-id="'+ val.room_id +'" r-name="'+ capitalize( val.room_name ) +'" r-rate="'+ val.room_rate +'" r-desc="'+ capitalize( val.room_desc ) +'" r-equiv="'+ val.room_equiv +'" r-status="'+ capitalize( val.room_status ) +'" ><i class="mdi mdi-eye mdi-18px"></i> View</span>' );
        
        count++;
        return tdata;
      } );

      // Add data to the table
      table.rows.add( trdata ).draw();

      // Re-delegate click function on room-details class
      $('body').delegate('.room-details', 'click', function() {
        room_view_details( $(this) );
      });

      return true;
    }

    /**
     * ROOM DETAILS CLICK
     */
    $('.room-details').on( 'click', function() {
      room_view_details( $(this) );
    } );

    /**
     * HANDLES VALUES TO VIEW
     */
    function room_view_details( obj ) {
      
      // Assign values to modal input
      $('input[name="edit_room_id"]').val( obj.attr('r-id') );
      $('input[name="edit_room_name"]').val( obj.attr('r-name') );
      $('input[name="edit_room_equiv"]').val( obj.attr('r-equiv') );
      $('input[name="edit_room_desc"]').val( obj.attr('r-desc') );
      $('input[name="edit_room_delete"]').attr( 'id', obj.attr('r-id') );
      $('input[name="edit_room_rate"]').val( obj.attr('r-rate') );

      if ( obj.attr('r-status') == 'Full' ) {

        // Disabled and set select default value
        $('select[name="edit_room_status"]:first').val('Full');
        $('select[name="edit_room_status"]').attr('disabled', 'true');

      } else if ( obj.attr('r-status') == 'Occupied'  ) {

        // Disabled and set select default value
        $('select[name="edit_room_status"]:first').val('Occupied');
        $('select[name="edit_room_status"]').attr('disabled', 'true');

      } else {
        
        // Disabled and set select default value
        $('select[name="edit_room_status"]').removeAttr('disabled', 'false');
        $('select[name="edit_room_status"]:first').val( obj.attr('r-status') );
        
      }

      // Show modal
      $( '#room_modal' ).modal( 'show' );

      // Input icons
      input_icon_reset();

      // Initialize select2
      $('.select2').select2({width: 'calc(100% - 65px)'});
    }

    /**
     * DELEGAT EVENT TO PAGINATION
     */
    $('.paginate_button').on('click', function() {
      $('body').delegate('.room-details', 'click', function() {
        room_view_details( $(this) );
      });
    });

  });
})(jQuery);
