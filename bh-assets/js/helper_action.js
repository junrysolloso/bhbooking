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

  // Set same height
  var mH = $('.content-aside-right').height();
  $('.card.w-100.auth.theme-one').css('min-height', ( mH + 70 ) + 'px');
  $('.sidebar-menu').css('min-height', ( mH + 165 ) + 'px');
  
  // Database backup
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

});
