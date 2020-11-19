<?php  
class Sms extends MY_Controller 
{
	public function __construct() {
    parent::__construct();
    //$this->load->helper('sendsms_helper');
  }


  public function index() {
	
	// 	/*Check submit button */
	// 	if($this->input->get('p')) {

  //     $phone=$this->input->get('p');
  //     $user_message=$this->input->get('m');

  //     /*Your authentication key*/
  //     $authKey = "3456655757gEr5a019b18";

  //     /*Multiple mobiles numbers separated by comma*/
  //     $mobileNumber = $phone;

  //     /*Sender ID,While using route4 sender id should be 6 characters long.*/
  //     $senderId = "ABCDEF";

  //     /*Your message to send, Add URL encoding here.*/
  //     $message = $user_message;

  //     /*Define route */
  //     $route = "route=4";

  //     /*Prepare you post parameters*/
  //     $postData = array(
  //       'authkey' => $authKey,
  //       'mobiles' => $mobileNumber,
  //       'message' => $message,
  //       'sender'  => $senderId,
  //       'route'   => $route
  //     );

  //     /*API URL*/
  //     $url="https://control.msg91.com/api/sendhttp.php";

  //     /* init the resource */
  //     $ch = curl_init();
  //     curl_setopt_array($ch, array(
  //     CURLOPT_URL => $url,
  //     CURLOPT_RETURNTRANSFER => true,
  //     CURLOPT_POST => true,
  //     CURLOPT_POSTFIELDS => $postData
  //     /*,CURLOPT_FOLLOWLOCATION => true*/
  //     ));

  //     /*Ignore SSL certificate verification*/
  //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  //     /*get response*/
  //     $output = curl_exec($ch);

  //     /*Print error if any*/
  //     if(curl_errno($ch)) {
  //       echo 'error:' . curl_error($ch);
  //     }
      
  //     curl_close($ch);          
  //     echo "Message Sent Successfully !";
	// 	}

  
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