(function($){
  'use strict';

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

    $('#booker-photo').attr('src', $('input#base_url').val() + '/bh-uploads/' + obj.attr('b-photo') );

    // Show modal
    $('#boarder_details').modal('show');

    // Reset icon
    input_icon_reset();

  }

  /**
   * DELEGAT EVENT TO PAGINATION
   */
  $('.paginate_button').on('click', function() {
    $('body').delegate('.user-details', 'click', function() {
      assign_values( $(this) );
    });
  });

})(jQuery);