(function ($) {
  'use strict';
  // Initialize tables
  // Settings Table
  $(function () {
    $('#pendings, #cancelled').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: false,
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 20,
      "bLengthChange": false,
    });
  });

  $(function () {
    $('#logs-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: true,
      bSort: true,
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 14,
      "bLengthChange": false,
    });
  });

  $(function () {
    $('#room-table, #user-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: true,
      bSort: true,
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 10,
      "bLengthChange": false,
    });
  });

  // Use DataTable in searching tables
  $('input[name="data_search"]').on('keyup', function () {
    var s_value = $(this).attr('id');
    switch (s_value) {
      // Inventory
      case 'inv-grocery':
        $('#inv-grocs-table').DataTable().search($(this).val()).draw();
        break;
      case 'inv-pharmacy':
        $('#inv-pharm-table').DataTable().search($(this).val()).draw();
        break;
      case 'inv-damage':
        $('#inv-damag-table').DataTable().search($(this).val()).draw();
        break;
      case 'inv-beauty':
        $('#inv-beaut-table').DataTable().search($(this).val()).draw();
        break;

      // Orders
      case 'ord-history':
        $('#ord-histo-table').DataTable().search($(this).val()).draw();
        break;
      case 'ord-items':
        $('#ord-items-table').DataTable().search($(this).val()).draw();
        break;

      // Settings
      case 'set-users':
        $('#set-users-table').DataTable().search($(this).val()).draw();
        break;
      case 'set-logss':
        $('#set-logss-table').DataTable().search($(this).val()).draw();
        break;

      // View Products
      case 'view-products':
        $('#view-prod-table').DataTable().search($(this).val()).draw();
        break;
      default:
        console.log('Error seaching data!');
        break;
    }
  });
})(jQuery);
