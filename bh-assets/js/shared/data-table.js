(function ($) {

  // Initialize tables
  // Settings Table
  $(function () {
    $('#set-damag-table, #cahier-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 10,
      "bLengthChange": false,
    });
  });

  $(function () {
    $('#set-users-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: false,
      bSort: true,
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 10,
      "bLengthChange": false,
    });
  });

  $(function () {
    $('#set-logss-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 50,
      "bLengthChange": false,
    });
  });

  // Dashboard
  $(function () {
    $('#das-cahie-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 10,
      "bLengthChange": false,
    });
  });

  // Sales Table
  $(function () {
    $('#sal-pharma-table, #sal-grocs-table, #sal-beauty-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 15,
      "bLengthChange": false,
    });
  });

  // Orders Table
  $(function () {
    $('#ord-histo-table, #ord-items-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 5,
      "bLengthChange": false,
    });
  });

  $(function () {
    $('#ord-added-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      paging: false,
      "iDisplayLength": 10,
      "bLengthChange": false,
    });
  });

  // Inventory Table
  $(function () {
    $('#inv-grocs-table, #inv-pharm-table, #inv-beaut-table, #inv-damag-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 50,
      "bLengthChange": false,
    });
  });

  // Category & Sub Table
  $(function () {
    $('#cat-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: false,
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 50,
      "bLengthChange": false,
    });
  });

    // Sub-category Table
    $(function () {
      $('#cat-sub-table').DataTable({
        "aLengthMenu": [
          [5, 10, 15, -1],
          [5, 10, 15, "All"]
        ],
        paging: true,
        bFilter: false,
        bInfo: false,
        "iDisplayLength": 5,
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
      default:
        console.log('Error seaching data!');
        break;
    }
  });

})(jQuery);
