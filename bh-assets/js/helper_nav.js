(function($){
  'use strict';
  $(function(){
    // Set nav menu active when in the specified page
    if ($('.nav').length) {
      // Add active to selected nav link
      var navItem = document.getElementsByClassName('nav-item'), i;
      let url = $(location).attr('href'),
        urlKey = url.replace(/\/\s*$/, "").split('/').pop();
      for (i = 1; i < navItem.length; i++) {
        navItem[i].getAttribute('id') == urlKey ? navItem[i].classList.add('active') : false;
      }
    }
  });
})(jQuery);
