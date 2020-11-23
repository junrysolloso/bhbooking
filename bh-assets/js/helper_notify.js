(function($){
  'use strict';
  
  var b_count, c_count;

  /**
   * WEBSITE NOTIFICATION
   */
  const post_n = function(){

    // Pendings
    $.post( $('input#base_url').val() + 'settings/notifier', {n_status: 'pending'} ).done(function(data){
      
      // Set booking count
      b_count = data.count;

      $('.count-indicator').append('<span class="count bg-info"></span>');
      if ( parseInt( data.time.d ) == 0 ) {
        $('#book-count').text( ( data.count == 0 ? 0 : data.count ) + ' New Booking(s)' );
        $('#book-count-time').text( data.time.h + 'hr ' + data.time.i + 'min' );
      } else {
        $('#book-count').text( ( data.count == 0 ? 0 : data.count ) + ' New Booking(s)' );
        $('#book-count-time').text( data.time.d + ' day(s) ' + data.time.h + 'hr ' + data.time.i + 'min ' );
      } 
    });

    // Cancelled
    setTimeout(function(){
      $.post( $('input#base_url').val() + 'settings/notifier', {n_status: 'cancelled'} ).done(function(data){
  
        $('.count-indicator').append('<span class="count bg-info"></span>');
        if ( parseInt( data.time.d ) == 0 ) {
          $('#cancel-count').text( ( data.count == 0 ? 0 : data.count ) + ' Cancelled Booking(s)' );
          $('#cancel-count-time').text( data.time.h + 'hr ' + data.time.i + 'min' );
        } else {
          $('#cancel-count').text( ( data.count == 0 ? 0 : data.count ) + ' Cancelled Booking(s)' );
          $('#cancel-count-time').text( data.time.d + ' day(s) ' + data.time.h + 'hr ' + data.time.i + 'min ' );
        } 
        
      });
    }, 500);
  };

  /**
   * DESKTOP NOTIFICATION
   */
  const desktop_notify = function(text) {
    
    var options = {
      title: "Alex Boarding House",
      config: {
        body: text,
        icon:  $('#base_url').val() + "bh-uploads/dinagat-coders-icon.png",
        lang: 'en-US',
        onClose: "",
        onClick: openURL,
        onError: ""
      }
    };
    
    if (Notification.permission === "granted") {

      var notification = new Notification(options.title, options.config);

      notification.onclose = function() {
        if (typeof options.config.onClose === 'function') {
          options.config.onClose();
        }
      };

      notification.onclick = function() {
        if (typeof options.config.onClick === 'function') {
          options.config.onClick();
        }
      };

      notification.onerror = function() {
        if (typeof options.config.onError === 'function') {
          options.config.onError();
        }
      };

    } else if (Notification.permission !== 'denied') {
      Notification.requestPermission(function(permission) {
        if (permission === "granted") {
          notify.init();
        }
      });
    }
  }

  // Open url on notification click
  const openURL = function() {
    open($('#base_url').val() + 'booking/pendings');
  }

  // Set interval
  setInterval(() => {
    post_n();
  }, 10000);

  setInterval(() => {
    if ( c_count > 0 ) {
      desktop_notify("You have " + c_count + " cancelled booking(s).");
    }
  }, 11000);

  setInterval(() => {
    if ( b_count > 0 ) {
      desktop_notify("You have " + b_count + " new booking(s).");
    }
  }, 12000);

})(jQuery);