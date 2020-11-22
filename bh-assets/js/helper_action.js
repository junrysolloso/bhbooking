$(document).ready(function () {
  
  // Reset icon size
  $('input').closest('.input-group').find('.mdi').addClass('mdi-18px');
  $('select').closest('.input-group').find('.mdi').addClass('mdi-18px');

  // Input events
  $('input').on('keyup', function () {
    input_icon($(this));
  });

  // Select events
  $('select').on('change', function () {
    input_icon($(this));
  });

  // Inputmask
  $(":input").inputmask();

  //Initialize Select2 Elements
  $('.select2').select2({width: 'calc(100% - 65px)'});
  
  /**
   * DATABASE BACKUP
   */
  $('#db-backup').on('click', function() {
    $.post( $('input#base_url').val() + 'backup', { backup: 'Db Backup' } ).done( function( data ) {

      // Get server response
      if ( data.msg == 'success' ) {
        
        // Show success message
        swal({
          title: "Done!",
          text: "Database backup successful.",
          icon: "success",
          buttons: {
            cancel: true,
            confirm: {
              text: 'Download Backup',
            }
          },
          closeOnClickOutside: false,
        })
        .then(( value ) => {
  
          // Fire the callback
          if ( value ) {
            open( $('input#base_url').val() + 'bh-backup/' + data.file );
          } else {
            swal.close();
          }
        });
      }
    });
  });

  /**
   * PAYMENT
   */
  $('#payment').on('click', function(){
    $('#payment_modal').modal('show');
  });

  /**
   * SUBMIT PAYMENT
   */
  $('#form-payment').submit(function( event ) {
    event.preventDefault();
    
    // Get Values
    var data = {
      user_id: $('select[name="pay_booker"]').val(),
      book_id: $('select[name="pay_booker"]>option:selected').attr('b-id'),
      room_id: $('select[name="pay_booker"]>option:selected').attr('r-id'),
      amount : $('input[name="pay_amount"]').val(),
    }

    if ( data_checker(data) ) {
      $.post( $('input#base_url').val() + 'settings/add-payment', data ).done(function(data) {

        // Show message
        switch (data.msg) {
          case 'added':
            swal("Payment successfully added.", {
              icon: "success",
            });
            break;
          case 'updated':
            swal("Payment successfully updated.", {
              icon: "success",
            });
            break;
            case 'no-latest':
            swal("Please check payment amount.", {
              icon: "warning",
            });
            break;
          default:
            swal("Payment cannot be process.", {
              icon: "error",
            });
            break;
        }
      });
    }
  });

});
