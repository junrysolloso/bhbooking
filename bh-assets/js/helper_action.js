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
   * VIEW REPORT
   */
  $('#form-report-month').submit(function(event){
    event.preventDefault();
    var month = $('select[name="report_month"]').val();
    open( base_url + 'report/payment/?s=month&d=' + month );
  });

  $('#form-report-year').submit(function(event){
    event.preventDefault();
    var year = $('select[name="report_year"]').val();
    if ( $('input[name="report_data"]').val() == 'year' ) {
      open( base_url + 'report/payment/?s=year&d=' + year );
    } else {
      open( base_url + 'report/boarder/?d=' + year );
    }
  });

  $('#report-boarder-list').on('click', function() {
    $('input[name="report_data"]').val('boarder');
    $('#report_year_modal').modal('show');
  });

  $('#report-month-btn').on('click', function() {
    $('#report_month_modal').modal('show');
  });

  $('#report-year-btn').on('click', function() {
    $('input[name="report_data"]').val('year');
    $('#report_year_modal').modal('show');
  });

  // No access
  $('.no-access').on('click', function(){
    swal({
      title: 'Warning!',
      text: "No user privilege for this account.",
      icon: 'warning',
      dangerMode: true,
    })
  });

  /**
   * DATABASE BACKUP
   */
  $('#db-backup').on('click', function() {
    $.post( base_url + 'backup', { backup: 'Db Backup' } ).done( function( data ) {

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
            open( base_url + 'bh-backup/' + data.file );
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
    $('input[name="pay_room_rate"]').val( $('select[name="pay_booker"]>option:selected').attr('r-rate') );
    $('#payment_modal').modal('show');
    input_icon_reset();
  });

  $('select[name="pay_booker"]').change(function(){
    $('input[name="pay_room_rate"]').val( $('select[name="pay_booker"]>option:selected').attr('r-rate') );
  });

  $('#add-pay-btn').on('click', function(){
    $('#add-pay-container').append('<div class="row"><div class="col-6"><div class="form-group"><div class="input-group"><input type="number" step="0.01" name="pay_amount[]" class="form-control pay-amount-mark" required /><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div></div><div class="col-6"><div class="form-group"><div class="input-group"><input type="text" name="pay_date[]" class="form-control" data-inputmask="\'alias\': \'datetime\'" data-inputmask-inputformat="yyyy-mm-dd" required im-insert="false" /><div class="input-group-append"><span class="input-group-text text-danger remove-pay-btn"><i class="mdi mdi-minus-circle-outline mdi-18px"></i>&nbsp;Remove</span></div></div></div></div></div>');
    
    // Delegat remove button
    $('body').delegate('.remove-pay-btn', 'click', function(){
      $(this).closest('.row').remove();
    });

    $('body').delegate('input', 'keyup', function(){
      input_icon($(this));
    });

    $('body').delegate('.pay-amount-mark', 'mouseleave', function(){
      if ( $(this).val() != '' && parseInt( $(this).val() ) != parseInt( $('input[name="pay_room_rate"]').val() ) ) {
        if ( $(this).val('') ) {
          showWarningToast('Amount must be equal with the room cost.');
        }
      }
    });
    
    // Inputmask
    $(":input").inputmask();
  });

  $('input[name="pay_amount[]"]').on('mouseleave', function(){
    if ( $(this).val() != '' && parseInt( $(this).val() ) != parseInt( $('input[name="pay_room_rate"]').val() ) ) {
      if ( $(this).val('') ) {
        showWarningToast('Amount must be equal with the room cost.');
      }
    }
  });

  /**
   * SUBMIT PAYMENT
   */
  $('#form-payment').submit(function( event ) {
    event.preventDefault();
    
    var p_amount = [];
    var p_date   = [];

    // Get Values
    $('input[name="pay_amount[]"]').each(function(i){
      p_amount[i] = $(this).val();
    });

    $('input[name="pay_date[]"]').each(function(i){
      p_date[i] = $(this).val();
    });

    var data = {
      user_id: $('select[name="pay_booker"]').val(),
      book_id: $('select[name="pay_booker"]>option:selected').attr('b-id'),
      room_id: $('select[name="pay_booker"]>option:selected').attr('r-id'),
      amount : p_amount,
      date   : p_date
    }

    if ( data_checker(data) ) {
      $.post( base_url + 'settings/add-payment', data ).done(function(data) {

        // Show message
        switch (data.msg) {
          case 'added':
            swal("Payment successfully added.", {
              icon: "success",
            });

            $('#form-payment').trigger('reset');
            $('#payment_modal').modal('hide');
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
