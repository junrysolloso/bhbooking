(function($){
  'use strict';
  $(function(){

    /**
     * LOCAL VARIABLES
     */
    var url     = base_url + 'booking/add-booking';
    var nav     = $( '.step-progress li' );
    var persons = 0;
    var datas   = [];

    /**
     * CHECK AVAILABILITY
     */
    $( 'button#check-btn' ).on( 'click', function() {
      if ( $( 'input[name="persons"]' ).val().length && $( 'input[name="persons"]' ).val() != 0 ) {
        
        // Data to check
        var check = {
          check_available: 'Check Available',
        }

        // Send request to the server
        $.post( base_url + 'booking/room', check).done( function( res ) {

          // If number of persons is less than the available beds
          if ( parseInt( res.beds ) >= parseInt( $( 'input[name="persons"]' ).val() ) ) {
            
            // Hide and show elements
            $( '#check' ).hide();
            $( '#personal' ).show();
            nav[1].classList.add( 'active' );

            // Show message
            showSuccessToast( 'Congratulations! we have available room for booking.' );
      
            // Populate fields for the given number of persons
            persons = parseInt( $( 'input[name="persons"]' ).val() );
            for ( var i = 0; i < persons; i++) {
              $( '.p-container').append('<h4 class="text-left">['+ ( i + 1 ) +'] Person Details</h4><div class="form-group"><div class="input-group"><input type="text" name="fname[]" class="form-control" placeholder="Full Name" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div><div class="form-group"><div class="input-group"><input type="text" name="phone[]" class="form-control" placeholder="Phone Number" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div><div class="form-group"><div class="input-group"><input type="email" name="email[]" class="form-control email" placeholder="Email Address" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div><div class="form-group"><div class="input-group"><input type="text" name="address[]" class="form-control" placeholder="Address" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div><div class="form-group"><div class="input-group"><input type="text" name="arrival[]" value="" class="form-control" data-inputmask="\'alias\': \'datetime\'" data-inputmask-inputformat="yyyy-mm-dd" placeholder="Arrival Date" required im-insert="false"><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div>' );
              
              // Initialize input mask
              $( ":input" ).inputmask();
              
              // Delegate input events
              $('body').delegate('input', 'keyup', function() { 
                input_icon($(this));
              });

              $('body').delegate('.email', 'mouseleave', function() { 
                exist_checker( $(this), base_url + 'settings/user', 'email' );
              });
            }
          } 
          
          // If number of persons is greater than the available beds
          else if ( parseInt( $( 'input[name="persons"]' ).val() ) > parseInt( res.beds ) && parseInt( res.beds ) != 0 ) {
            showWarningToast( 'We have only '+ res.beds +' bed(s) available.' );
          } 
          
           // If available beds is zero
          else if ( parseInt( res.beds ) == 0 ) {
            showErrorToast( 'Sorry! No room is available right now.' );
          }

        });
      } else {
        showErrorToast( 'Number of persons cannot be zero or empty.' );
        input_icon_reset();
      }
    });


    /**
     * PERSONAL DETAILS VALUES
     */
    $('button#personal-btn').on('click', function() {
      
      // Array variables
      var profile = [], fname=[], phone=[], email=[], address=[], arrival=[];

      // Get fields data  
      $( 'input[name="fname[]"]' ).each(function(){
        fname.push( $(this).val() );
      });

      $( 'input[name="phone[]"]' ).each(function(){
        phone.push( $(this).val() );
      });

      $( 'input[name="email[]"]' ).each(function(){
        email.push( $(this).val() );
      });

      $( 'input[name="address[]"]' ).each(function(){
        address.push( $(this).val() );
      });

      $( 'input[name="arrival[]"]' ).each(function(){
        arrival.push( $(this).val() );
      });

      // Add to main array
      profile.push( fname );
      profile.push( phone );
      profile.push( email );
      profile.push( address );
      profile.push( arrival );

      if ( data_checker( profile ) ) {
        
        // Push data to main array
        datas.push( profile );

        // Hide & Show Elements
        $('#personal').hide();
        $('#login').show();
        nav[2].classList.add('active');
        
        // Populate login details fields
        persons = parseInt( $( 'input[name="persons"]' ).val() );
        for ( var i = 0; i < persons; i++) {
          $('.l-container').append('<h4 class="text-left pt-3">['+ ( i + 1 ) +'] Person Login Details</h4><div class="form-group"><div class="input-group"><input type="text" name="username[]" class="form-control username" placeholder="Username" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div><div class="form-group"><div class="input-group"><input type="password" name="password[]" class="form-control user-checker" placeholder="Password" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div><div class="form-group"><div class="input-group"><input type="password" name="confirm[]" class="form-control" placeholder="Confirm Password" required><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-check-circle-outline mdi-18px"></i></span></div></div></div>');
          
          // Delegate input events
          $('body').delegate('input', 'keyup', function() { 
            input_icon($(this));
          });

          $('body').delegate('.username', 'mouseleave', function() { 
            exist_checker( $(this), base_url + 'settings/user', 'user' );
          });
        }
      }
    });

    /**
     * CHECK USERNAME
     */
    function exist_checker( obj, url, arg ) {

      // Parameter to check
      var check = {
        value      : obj.val(),
        user_check : arg,
      }

      // Send post request to the server for checking username
      $.post( url, check ).done( function( data ) {

        if ( data.msg == undefined ) {

          // Clear fields with the existing username
          obj.val('');
        
          // Input icons
          input_icon_reset();

          // Show warning message
          switch (arg) {
            case 'user':
              showWarningToast( 'Username already exist.');
              break;
            case 'email':
              showWarningToast( 'Email already exist.');
              break;
            default:
              break;
          }
        }
      });
    }

    /**
     * LOGIN DETAILS VALUES
     */
    $('button#login-btn').on('click', function() {
      
      // Array variables
      var login = [], username = [], password = [], confirm = [], i, flag = true;

      // Get fields data
      $( 'input[name="username[]"]' ).each(function(){
        username.push( $(this).val() );
      });

      $( 'input[name="password[]"]' ).each(function(){
        password.push( $(this).val() );
      });

      $( 'input[name="confirm[]"]' ).each(function(){
        confirm.push( $(this).val() );
      });

      // Add to main array
      login.push( username );
      login.push( password );
      login.push( confirm );

      // Check values
      if ( data_checker(login) ) {
        for (i = 0; i < login.length; i++) {
          if (login[1][i] != login[2][i]) {
            flag = false;
            showErrorToast('Person ['+ (i + 1) +'] password does not match.');
          }
        }

        // Check flag value
        if( flag ) {

          // Push data to main array
          datas.push( login );
          
          $.post( url, { book: datas } ).done( function() {

            // Show booking success
            $('#login').hide();
            $('#finish').show();
            nav[3].classList.add('active');

          }).fail( function() {

            // Show error message
            showErrorToast( 'Sorry! we\'re having trouble adding your booking.' );
          } );
        } 
      }
    });

    /**
     * BACK TO CHECK AVAILABILITY
     */
    $('button#personal-back').on('click', function() {
      $('#personal').hide();
      $('#check').show();
      nav[1].classList.remove('active');

      // Clear fields
      $('.p-container').html('');
    });


    /**
     * BACK TO PERSONAL DETAILS
     */
    $('button#login-back').on('click', function() {
      $('#login').hide();
      $('#personal').show();
      nav[2].classList.remove('active');

      // Clear fields
      $('.l-container').html('');
    });


    /**
     * CLEAR FIELDS
     */
    $( 'input[name="persons"]' ).on('keyup', function() {
      
      // Clear all fields
      $('.p-container').html('');
      $('.l-container').html('');
    });

    /**
     * RESET INPUT ICONS
     */
    $('input').on('keyup', function () {
      input_icon($(this));
    });

  });
})(jQuery);
