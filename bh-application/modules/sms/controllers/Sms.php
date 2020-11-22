<?php  
class Sms extends MY_Controller 
{
	public function __construct() {
    parent::__construct();
    
    Sess::admin();

  }

  /**
   * SMS SENDER
   */
  public function index() {
  
    $ch = curl_init();

    $parameters = array(
      'apikey'     => '9d631d85d9774de3ad0dbd83e66b5170', //Your API KEY
      'number'     => '09108973533',
      'message'    => 'I just sent my first message with Semaphore',
      'sendername' => 'SEMAPHORE'
    );

    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt( $ch, CURLOPT_POST, 1 );

    // Send the parameters set above with the request
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

    // Receive response from server
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close ($ch);

    // Show the server response
    echo $output;

  }
}