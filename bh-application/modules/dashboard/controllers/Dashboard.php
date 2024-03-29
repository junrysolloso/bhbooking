<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

  function __construct() {
    parent:: __construct(); 

    Sess::admin();

    $this->load->model( 'booking/Model_Booking' );
    $this->load->model( 'settings/Model_Payment' );
  }

	/**
	 * Index for the dashboard page
	 */
  public function index() {

    $data['title']    = 'Dashboard';
    $data['class']    = 'dashboard';
    $data['recent']   = $this->Model_Booking->get_bookings( NULL, 'active' );
    $data['list']     = $this->Model_Booking->get_bookings( NULL, 'list' );
    $data['payments'] = $this->Model_Payment->get_payments( NULL, 'all' );
    $data['labels']   = $this->Model_Payment->get_yearly_total()[0];
    $data['totals']   = $this->Model_Payment->get_yearly_total()[1];
    $data['years']    = $this->Model_Payment->get_years();
    $data['months']   = $this->Model_Payment->get_months();

    // Load template parts
    $this->template->set_master_template( 'layouts/layout_admin' );
    $this->template->write( 'title', $data['title'] );
    $this->template->write( 'body_class', $data['class'] );

    $this->template->write_view( 'content', 'templates/template_topbar', $data );
    $this->template->write_view( 'content', 'templates/template_left_side' );
    $this->template->write_view( 'content', 'view_dashboard' );
    $this->template->write_view( 'content', 'templates/template_right_side' );
    $this->template->write_view( 'content', 'templates/template_footer' );

    // Modals
    $this->template->write_view( 'content', 'modals/modal_payment' );
    $this->template->write_view( 'content', 'modals/modal_date' );

    // Add additional assests for this page
    $this->template->add_css( 'bh-assets/vendors/nouislider/nouislider.min.css' );
    $this->template->add_js( 'bh-assets/vendors/chart.js/Chart.min.js' );
    $this->template->add_js( 'bh-assets/vendors/nouislider/nouislider.min.js' );
    $this->template->add_js( 'bh-assets/js/pages/page_dashboard.js' );

		$this->template->render();
  }

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */
