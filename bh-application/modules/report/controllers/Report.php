<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller 
{

  function __construct() {
    parent:: __construct();

    Sess::admin();

    $this->load->library( 'pdf' );

    $this->load->model( 'booking/Model_Booking' );
    $this->load->model( 'settings/Model_Payment' );
    
  }

  /**
   * BOARDER REPORT
   */
  public function boarder() {
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
      if ( ! empty( $this->input->get( 'd' ) ) ) {

        $date = $this->input->get( 'd' );

        $data['title'] = 'Boarders';
        $data['page_title']  = 'Boarders '. $date .' Report ';
        $data['list']  = $this->Model_Booking->get_bookings( NULL, 'year', $date );
    
        // Load template parts
        $this->template->write( 'title', $data['title'] );
        $this->template->write_view( 'content', 'view_boarders', $data );
    
        // Generate pdf
        $content = $this->template->render( NULL, true );
        $this->pdf->create_pdf( $content, 'boarder-report', false );
      }
    }
  }

  /**
   * PAYMENT REPORT
   */
  public function payment() {
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
      
      $request = $this->input->get( 's' );
      $date    = $this->input->get( 'd' );

      if ( ! empty( $this->input->get( 's' ) ) || ! empty( $this->input->get( 'd' ) ) ) {
        $data['title'] = 'Payments Report';
        
        switch ( $request ) {
          case 'recent':
            $data['page_title'] = 'Recent Payment Report';
            $data['payments'] = $this->Model_Payment->get_payments( NULL, 'all' );
            break;
          case 'month':
            $data['page_title'] = $date .' '. date( 'Y' ) .' Payment Report';
            $data['payments'] = $this->Model_Payment->get_payments( NULL, 'month', $date );
            break;
          case 'year':
            $data['page_title'] = 'Year '. $date .' Payment Report';
            $data['payments'] = $this->Model_Payment->get_payments( NULL, 'year', $date );
            break;
          default:
            break;
        }

        // Load template parts
        $this->template->write( 'title', $data['title'] );
        $this->template->write_view( 'content', 'view_payment', $data );

        // Generate pdf
        $content = $this->template->render( NULL, true );
        $this->pdf->create_pdf( $content, ucwords( $data['page_title'] ), false );
      }
    }
  }

}