(function ($) {
  'use strict';
  $(function () {
    
    /**
     * CONFIRM BOOKING EVENT
     */
    $('.confirm-booking').on('click', function(){
      confirm_booking( $(this) );
    });

    /**
     * CONFIRM BOOKING
     * 
     * @param {object} obj 
     */
    function confirm_booking( obj ) {

      // Get ids
      var data = {
        p_book_id: obj.attr('b-id'),
        p_room_id: obj.attr('r-id'),
        p_user_id: obj.attr('u-id'),
      }

      // Confirmation
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
          
          // Send request to the server
          $.post( base_url + 'booking/update-status', data ).done(function( data ) {

            // Populate table
            if ( pendings_table_draw( data ) ) {

              // Show success message
              swal("Booking successfully confirm.", {
                icon: "success",
              });
            }
          });
        } else {
          swal.close();
        }
      });
    }

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
            if ( pendings_table_draw( data ) ) {

              // Show success message
              swal("Booking successfully cancelled.", {
                icon: "warning",
              });
            }
          });
        } else {
          swal.close();
        }
      });
    }

    /**
     * TABLE DRAW
     */
    function pendings_table_draw( data ) {

      // Define the table to be updated
      var table = $('#pendings-table').DataTable(), count = 1;

      // Clear the table
      table.clear();

      // Map table values
      var trdata = data.map( function( val ) {
        var tdata  = [];

        // Push data to the array
        tdata.push( count );
        tdata.push( capitalize( val.user_fname ) );
        tdata.push( val.user_phone );
        tdata.push( '<div class="d-flex flex-column"><span class="mb-2 font-weight-medium">'+ $.format.date( val.book_date, 'MMM dd, yyyy' ) +'</span><small class="text-muted">'+ $.format.date( val.book_date, 'hh:mm:ss a' ) +'</small></div>' );
        tdata.push( $.format.date( val.book_arrival + '01:10:20', 'MMM dd, yyyy' ) );
        tdata.push( '<i class="mdi mdi-plus-box-outline mdi-24px text-primary confirm-booking" r-id="'+ val.room_id +'" b-id="'+ val.book_id +'" u-id="'+ val.user_id +'"></i>&nbsp;<i class="mdi mdi-minus-box-outline mdi-24px text-danger cancel-booking" r-id="'+ val.room_id +'" b-id="'+ val.book_id +'" u-id="'+ val.user_id +'"></i></td>' );
        
        count++;
        return tdata;
      } );

      // Add data to the table
      table.rows.add( trdata ).draw();

      // Re-delegate click function on room-details class
      $('body').delegate('.confirm-booking', 'click', function() {
        confirm_booking( $(this) );
      });

      $('body').delegate('.cancel-booking', 'click', function() {
        cancel_booking( $(this) );
      });

      return true;
    }
   
  });
})(jQuery)