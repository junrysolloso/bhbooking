(function ($) {
  'use strict';

  var p_paging = false, c_paging = false, i;

  $(document).ready(function(){

    // Check if row count is greater that 14 
    // then set paging to true
    if ( $('.pending-count').length ) {
      var p_count = $('.pending-count').val();
      if ( p_count > 14 ) {
        p_paging = true;
      }
    }

    if ( $('.cancelled-count').length ) {
      var c_count = $('.cancelled-count').val();
      if ( c_count > 14 ) {
        c_paging = true;
      }
    }
    
    // Table values
    var ar_tables = ['#pendings-table', '#cancelled-table', '#logs-table', '#room-table', '#user-table', '#list-table', '#booker-payments-table', '#recent-pays-table'];
    var ar_paging = [p_paging, c_paging, true, true, false, true, true, true];
    var ar_filter = [true, true, true, true, true, true, true, true];
    var ar_sort   = [true, true, true, true, true, true, true, true];
    var ar_info   = [false, false, false, false, false, false, false, false];
    var ar_dlen   = [14, 14, 12, 8, 8, 14, 5, 8];

    // Populate DataTable if table id is present
    for (i = 0; i < ar_tables.length; i++) {
      if ( $( ar_tables[i] ).length ) {
        $( ar_tables[i] ).DataTable({
          "aLengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
          ],
          paging  : ar_paging[i],
          bFilter : ar_filter[i],
          bSort   : ar_sort[i],
          bInfo   : ar_info[i],
          "iDisplayLength": ar_dlen[i],
          "bLengthChange" : false,
        });
      }
    }

    // Search input
    if ( $('input[name="data_search"]').length ) {
      $('input[name="data_search"]').on('keyup', function () {
        var s_value = $(this).attr('id');
    
        // Switch element id
        switch (s_value) {
          case 'pendings':
            $('#pendings-table').DataTable().search($(this).val()).draw();
            break;
          case 'cancelled':
            $('#cancelled-table').DataTable().search($(this).val()).draw();
            break;
          case 'list':
            $('#list-table').DataTable().search($(this).val()).draw();
            break;
          case 'logs':
            $('#logs-table').DataTable().search($(this).val()).draw();
            break;
          default:
            break;
        }
      });
    }
  });
})(jQuery);
