<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Dashboard extends MY_Model
{
  
  /**
   * Tables to join for daily sales
   */
  protected $_relate_items        = 'tbl_items';
  protected $_relate_sales        = 'tbl_sales';
  protected $_relate_salesinfo    = 'tbl_salesinfo';
  protected $_relate_category     = 'tbl_category';
  protected $_relate_subcategory  = 'tbl_subcategory';
  protected $_relate_ucjunc       = 'tbl_ucjunc';
  protected $_relate_unitconvert  = 'tbl_unitconvert';
  protected $_relate_unit         = 'tbl_unit';

  /**
   * Table columns
   */
  protected $_category_name       = 'category_name';
  protected $_sales_date          = 'sales_date';
  protected $_sales_id            = 'sales_id';
  
  function __construct() {
    parent:: __construct();
  }

  /**
   * Get the daily sales
   * @param date $date
   * @return array
   */
  public function daily_sales( $limit ) {
    if ( ! empty( $limit ) ) {

      /**
       * Variable for storing array of date and total
       */
      $sales_label  = array();
      $sales_total  = array();
  
      /**
       * Get all the categories
       */
      $categories = $this->db->select( '`category_id` AS `id`, `category_name`' )->get( $this->_relate_category )->result();

      /**
       * Date reference
       */
      $m_date = date( 'Y-m-d' );
      $c_date = strtotime( $m_date );
  
      /**
       * Loop through all categories
       */
      foreach ( $categories as $row ) {

        /**
         * Assign an array variable to a 
         * specific category.
         */
        $sales_total[ $row->id ] = array();
    
        for( $i=0; $i < $limit; $i++ ) { 

          /**
           * Perform day offset
           */
          $m_date = strtotime( '-'.$i.' day', $c_date );

          /**
           * Convert the day offset to date
           */
          $m_date = date( 'Y-m-d', $m_date );

          /**
           * Get the sum of the total sales for the specific day
           * with corresponds to the category.
           */
          $sum = $this->daily_sales_query( $row->category_name, $m_date );
          
          /**
           * Push the sum to the array
           */
          array_push( $sales_total[ $row->id ], $sum );

          /**
           * Prevent the day from push when every category is loop
           */
          if( count( $sales_label ) < $limit ) {
            /**
             * Re-format and push the date
             */
            array_push( $sales_label, date_format( date_create( $m_date ), 'M j' ) );
          }
        }
      }
      return array( $sales_label, $sales_total );
    }
  }

  /**
   * Get today's sales
   * @return array $result
   */
  public function today_sales() {
    /**
     * Data to return
     */
    $this->db->select('`item_name`, `item_description` AS `desc`, ((`unit_price` * `no_of_items`) - `sales_discount`) AS `sales_total`, `no_of_items`, `unit_desc`');

    /**
     * Query parameters
     */
    $this->db->where( $this->_sales_date, date( 'Y-m-d' ) );
    $this->db->order_by( '`tbl_sales`.`sales_id`', 'DESC' );

    /**
     * Join all required tables
     */
    $this->db->join( $this->_relate_salesinfo, '`tbl_sales`.`sales_id`=`tbl_salesinfo`.`sales_id`' );
    $this->db->join( $this->_relate_items, '`tbl_items`.`item_id`=`tbl_salesinfo`.`item_id`' );
    $this->db->join( $this->_relate_subcategory, '`tbl_subcategory`.`subcat_id`=`tbl_items`.`subcat_id`' );
    $this->db->join( $this->_relate_category, '`tbl_subcategory`.`category_id`=`tbl_category`.`category_id`' );
    $this->db->join( $this->_relate_ucjunc, '`tbl_items`.`item_id`=`tbl_ucjunc`.`item_id`' );
    $this->db->join( $this->_relate_unitconvert, '`tbl_ucjunc`.`uc_id`=`tbl_unitconvert`.`uc_id`' );
    $this->db->join( $this->_relate_unit, '`tbl_unit`.`unit_id`=`tbl_unitconvert`.`unit_id2`' );

    /**
     * Assign the query to a variable 
     * this will ne use for checking if the query is successful.
     */
    $query = $this->db->get( $this->_relate_sales );

    if( $query->num_rows() > 0 ) {
      return $query->result();
    } 
  }

  /**
   * Sales query
   * @param string $category
   * @param string $date
   * @return int $total
   */
  public function daily_sales_query( $category, $date ) {

    if( ! empty( $category ) && ! empty( $date ) ) { 
      /**
       * Data to return
       */
      $this->db->select('(SUM(`no_of_items` * `unit_price`) - `sales_discount`) AS `total`');

      /**
       * Query parameters
       */
      $this->db->where( $this->_category_name, $category );
      $this->db->where( $this->_sales_date, $date );

      /**
       * Join all required tables
       */
      $this->db->join( $this->_relate_salesinfo, '`tbl_sales`.`sales_id`=`tbl_salesinfo`.`sales_id`' );
      $this->db->join( $this->_relate_items, '`tbl_items`.`item_id`=`tbl_salesinfo`.`item_id`' );
      $this->db->join( $this->_relate_subcategory, '`tbl_subcategory`.`subcat_id`=`tbl_items`.`subcat_id`' );
      $this->db->join( $this->_relate_category, '`tbl_subcategory`.`category_id`=`tbl_category`.`category_id`' );

      /**
       * Assign the query to a variable 
       * this will ne use for checking if the query is successful.
       */
      $query = $this->db->get( $this->_relate_sales );

      if( $query->num_rows() > 0 ) {
        return $query->row()->total;
      } else {
        return 0;
      }
    }
  }

}

/* End of file Model_Dashboard.php */
/* Location: ./application/modules/dashboard/models/Model_Dashboard.php */
