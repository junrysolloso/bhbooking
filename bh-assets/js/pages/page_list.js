(function($){
  'use strict';

  $(document).ready(function(){

    // Add button
    $('#booker-payments-table_wrapper').closest('.row').find('.col-sm-12.col-md-5').prepend('<div id="btn-orders"><input type="button" name="mark_complete" value="Mark Complete" class="btn btn-danger submit-btn mark-complete" style="margin-bottom: -60px;" /></div>');

    $('.mark-complete').on('click', function(){
      $.post( $('input#base_url').val() + 'settings/user', { mark_uid: $(this).attr('u-id'), mark_bid: $(this).attr('b-id') } ).done(function(){
  
        $('#boarder_details').modal('hide');
  
        swal("Booker mark complete!", { icon: "success" });
      });
    });
  });

  /**
   * USER DETAILS EVENT
   */
  $('.user-details').on('click', function() {

    // Set values
    assign_values( $(this) );

  });

  /**
   * ASSIGN VALUES
   * 
   * @param {element} obj 
   */
  function assign_values(obj) {

    // Assign attribute values
    $('input[name="booker_fname"]').val( obj.attr('b-fname') );
    $('input[name="booker_email"]').val( obj.attr('b-email') );
    $('input[name="booker_phone"]').val( obj.attr('b-phone') );
    $('input[name="booker_room"]').val( obj.attr('b-room') );
    $('input[name="booker_date"]').val( obj.attr('b-date') );
    $('input[name="booker_arrival"]').val( obj.attr('b-arrival') );
    $('input[name="booker_add"]').val( obj.attr('b-address') );

    // Add ids
    $('input[name="mark_complete"]').attr('u-id', obj.attr('u-id') );
    $('input[name="mark_complete"]').attr('b-id', obj.attr('b-id') );

    $('#booker-photo').attr('src', $('input#base_url').val() + '/bh-uploads/' + obj.attr('b-photo') );
    $('#boarder-status').text( obj.attr('b-status') );
    $('#boarder-active').text( obj.attr('b-arrival') );

    // Status color
    if ( obj.attr('b-status') == 'Active' ) {
      $('#boarder-status').addClass('text-success');
    } else {
      $('#boarder-status').addClass('text-warning');
    }

    // Send request to the server
    $.post( $('input#base_url').val() + 'settings/list-payments', { user_id:  obj.attr('u-id') } ).done(function( data ) {
        
      // Show modal
      $('#boarder_details').modal('show');

      // Show table
      if ( data != '' ) {
        payments_table_draw( data );
      } else {
        $('#booker-payments-table').DataTable().clear().draw();
      }

    });

    // Reset icon
    input_icon_reset();

  }

    /**
     * TABLE DRAW
     */
    function payments_table_draw( data ) {

      // Define the table to be updated
      var table = $('#booker-payments-table').DataTable(), count = 1;

      // Clear the table
      table.clear();

      // Map table values
      var trdata = data.map( function( val ) {
        var tdata  = [];

        // Push data to the array
        tdata.push( count );
        tdata.push( $.format.date( val.pay_date, 'MMM dd, yyyy @ hh:mm:ss a' ) );
        tdata.push( '<span class="text-success">₱' + val.pay_amount + '</span>' );
        tdata.push( capitalize( val.user_fname ) );

        count++;
        return tdata;
      } );

      // Add data to the table
      table.rows.add( trdata ).draw();

      return true;
    }

  /**
   * DELEGAT EVENT TO PAGINATION
   */
  $('.paginate_button').on('click', function() {
    $('body').delegate('.user-details', 'click', function() {

      // Assign values
      assign_values( $(this) );

    });
  });

})(jQuery);