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
  $('.card.w-100.auth.theme-one').css('height', ( mH + 60 ) + 'px');
  $('.sidebar-menu').css('height', ( mH + 155 ) + 'px');
  
});
