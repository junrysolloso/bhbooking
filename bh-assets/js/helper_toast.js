/**
 * TOAST NOTIFICATIONS
 */

// Success
showSuccessToast = function(msg) {
  'use strict';
  $.toast({
    heading: 'Success',
    text: msg,
    showHideTransition: 'fade',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'bottom-right',
    hideAfter: 5000,
    allowToastClose: false,
  })
};

// Warning
showWarningToast = function(msg) {
  'use strict';
  $.toast({
    heading: 'Warning',
    text: msg,
    showHideTransition: 'fade',
    icon: 'warning',
    loaderBg: '#57c7d4',
    position: 'bottom-right',
    hideAfter: 5000,
    allowToastClose: false,
  })
};

// Error
showErrorToast = function(msg) {
  'use strict';
  $.toast({
    heading: 'Error',
    text: msg,
    showHideTransition: 'fade',
    icon: 'error',
    loaderBg: '#f2a654',
    position: 'bottom-right',
    hideAfter: 5000,
    allowToastClose: false,
  })
};

// Info
showInfoToast = function(msg) {
  'use strict';
  $.toast({
    heading: 'Message',
    text: msg,
    showHideTransition: 'fade',
    icon: 'info',
    loaderBg: '#46c35f',
    position: 'bottom-right',
    hideAfter: 5000,
    allowToastClose: false,
  })
};

/**
 * EMPTY VALUE CHECKER
 * @param {array} data 
 */
data_checker = function (data) {
  
  var flag = true, j, i;

  // Check for empty value
  for (i=0; i < data.length; i++) {
    if ( data[i] == '' ) {
      flag = false;
    } else {
      for (j = 0; j < data[i].length; j++) {
        if ( ! data[i][j].length ) {
          flag = false;
        }
      }
    }
  }

  // Check if flag is true or false
  if ( ! flag ) {
    $.toast({
      heading           : 'Error',
      text              : 'All fields is required.',
      showHideTransition: 'fade',
      icon              : 'error',
      loaderBg          : '#f2a654',
      position          : 'bottom-right'
    });
    
    // Reset Input Icons
    input_icon_reset();

    return false;
  } else {
    return true;
  }
}

/**
 * RESET INPUT ICON
 */
input_icon_reset = function () {

  // Input
  $('input').each(function(){
    input_icon($(this));
  });

  // Select
  $('select').each(function(){
    input_icon($(this));
  });
}

/**
 * SET ICON COLOR ON INPUT EVENT
 * @param {object} obj 
 */
input_icon = function (obj) {

  // loop through all the input fields
  obj.each(function () {
    if ((obj.val()).length > 0) {
      obj.closest('.input-group').find('.mdi').removeClass('mdi-close-circle-outline');
      obj.closest('.input-group').find('.input-group-text').removeClass('text-danger');

      obj.closest('.input-group').find('.input-group-text').addClass('text-success');
      obj.closest('.input-group').find('.mdi').addClass('mdi-check-circle-outline');
    } else {
      obj.closest('.input-group').find('.input-group-text').removeClass('text-success');
      obj.closest('.input-group').find('.mdi').removeClass('mdi-check-circle-outline');

      obj.closest('.input-group').find('.mdi').addClass('mdi-close-circle-outline');
      obj.closest('.input-group').find('.input-group-text').addClass('text-danger');
    }
  });
}

/**
 * CAPITALIZE FIRST LETTER
 * @param {string} str 
 * @param {bool} lower 
 */
const capitalize = (str, lower = false) => (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase()); 

/**
 * REMOVE WHITE SPACE INIDE WORDS
 * @param {string} str 
 */
const trim_whitespace = (str) => str.replace(/\s/g,'');

/**
 * BASE URL
 */
const base_url = $('input#base_url').val();
