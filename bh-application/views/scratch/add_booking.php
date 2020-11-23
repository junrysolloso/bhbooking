<?

  if ( $this->input->post( 'amount' ) ) {
        
    $flag    = false;
    $amounts = array();

    // Get post values
    $room_id = $this->input->post( 'room_id' );
    $user_id = $this->input->post( 'user_id' );
    $amount  = intval( $this->input->post( 'amount' ) );

    // Get room rate
    $room_rate = $this->Model_Room->get_room_rate( $room_id );

    if ( $amount < $room_rate ) {

      // Get latest amount paid
      $latest_amount = $this->Model_Payment->get_latest_amount( $user_id, $room_rate );

      // Check if their is a latest payment that is less that the room rate
      if ( ! empty( $latest_amount ) ) {
        if ( intval( $latest_amount[0]->amount ) < $room_rate ) {

          $amount  = ( $latest_amount[0]->amount + $amount );

          if ( $this->Model_Payment->update_payment( $latest_amount[0]->pay_id, $amount ) ) {
            $this->_response( array( 'msg' => 'updated' ) );
          }
        } 
      } else {
        $this->_response( array( 'msg' => 'no-latest' ) );
      }
    } elseif ( $amount == $room_rate ) {

      // Values to insert
      $data = array(
        'pay_amount'   => $amount,
        'pay_date'     => date( 'Y-m-d H:i:s' ),
        'pay_reciever' => $this->session->userdata( 'user_id' ),
        'user_id'      => $this->input->post( 'user_id' ),
        'book_id'      => $this->input->post( 'book_id' ),
      );

      if ( $this->Model_Payment->add_payment( $data ) ) {
        $this->_response( array( 'msg' => 'added' ) );
      } else {
        $this->_response( array( 'msg' => 'error' ) );
      }
    } else {
      
      // Get latest amount paid
      $latest_amount = $this->Model_Payment->get_latest_amount( $user_id, $room_rate );

      // Check if their is a latest payment that is less that the room rate
      if ( ! empty( $latest_amount ) ) {
        if ( intval( $latest_amount[0]->amount ) < $room_rate ) {

          if ( $this->Model_Payment->update_payment( $latest_amount[0]->pay_id, $room_rate ) ) {

            // Minus the latest amount if the booker has a latest payment
            // which is not equal to room rate
            $l_diff = $room_rate - intval( $latest_amount[0]->amount );

            // Set the new amount
            $amount = ( $amount - $l_diff );
            
          }
        } 
      }

      // Number of months to pay
      $months = ceil( $amount / $room_rate );
      
      if ( $months > 1 ) {
        
        // More that 1 month
        for ( $i=1; $i < $months; $i++ ) { 
          array_push( $amounts, $room_rate );
        }

        if ( ( $amount % $room_rate ) == 0 ) {
          for ($i=0; $i < $months; $i++) { 
            array_push( $amounts, $room_rate );
          }
        } else {

          // Remaining amount
          array_push( $amounts, ( $amount % $room_rate ) );
        }
      } else {

        // Only 1 month
        array_push( $amounts, $room_rate );
      }

      // Insert payment
      for ( $i=0; $i < $months; $i++ ) { 

        // Values to insert
        $data = array(
          'pay_amount'   => $amounts[ $i ],
          'pay_date'     => date( 'Y-m-d H:i:s' ),
          'pay_reciever' => $this->session->userdata( 'user_id' ),
          'user_id'      => $this->input->post( 'user_id' ),
          'book_id'      => $this->input->post( 'book_id' ),
        );

        if ( $this->Model_Payment->add_payment( $data ) ) {
          $flag = true;
        }
      }

      if ( $flag ) {
        $this->_response( array( 'msg' => 'added' ) );
      } else {
        $this->_response( array( 'msg' => 'error' ) );
      }
    }
  }