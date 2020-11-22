(function($){
  'use strict';
  
  var b_count;

  /**
   * WEBSITE NOTIFICATION
   */
  const post_n = function(){

    // Pendings
    $.post( $('input#base_url').val() + 'settings/notifier', {n_status: 'pending'} ).done(function(data){
      if ( parseInt( data.count ) > 0 ) {
        
        // Set booking count
        b_count = data.count;

        $('.count-indicator').append('<span class="count bg-info"></span>');
        if ( parseInt( data.time.d ) == 0 ) {
          $('#book-count').text( data.count + ' New Booking(s)' );
          $('#book-count-time').text( data.time.h + 'hr ' + data.time.m + 'min' );
        } else {
          $('#book-count').text( data.count + ' New Booking(s)' );
          $('#book-count-time').text( data.time.d + ' day(s) ' + data.time.h + 'hr ' + data.time.m + 'min ' );
        } 
      }
    });

    // Cancelled
    $.post( $('input#base_url').val() + 'settings/notifier', {n_status: 'cancelled'} ).done(function(data){
      if ( parseInt( data.count ) > 0 ) {
        $('.count-indicator').append('<span class="count bg-info"></span>');
        if ( parseInt( data.time.d ) == 0 ) {
          $('#cancel-count').text( data.count + ' Cancelled Booking(s)' );
          $('#cancel-count-time').text( data.time.h + 'hr ' + data.time.m + 'min' );
        } else {
          $('#cancel-count').text( data.count + ' Cancelled Booking(s)' );
          $('#cancel-count-time').text( data.time.d + ' day(s) ' + data.time.h + 'hr ' + data.time.m + 'min ' );
        } 
      }
    });
  };

  /**
   * DESKTOP NOTIFICATION
   */
  const desktop_notify = function() {
    
    var options = {
      title: "Alex Boarding House",
      config: {
        body: "You have " + b_count + " new booking(s).",
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

  // Open pendings url
  const openURL = function() {
    open($('#base_url').val() + 'booking/pendings');
  }

  // Set interval
  setInterval(() => {
    post_n();
  }, 10000);

  setInterval(() => {
    desktop_notify();
  }, 30000);

})(jQuery);