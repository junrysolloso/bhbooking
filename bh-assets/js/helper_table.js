(function ($) {
  'use strict';

  // Peding table
  $(function () {
    $('#pendings-table').DataTable({
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

  // Cancelled table
  $(function () {
    $('#cancelled-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: false,
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 14,
      "bLengthChange": false,
    });
  });

  // Logs table
  $(function () {
    $('#logs-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: true,
      bSort: true,
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 13,
      "bLengthChange": false,
    });
  });

  // Room table
  $(function () {
    $('#room-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: true,
      bSort: true,
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 8,
      "bLengthChange": false,
    });
  });

  // User table
  $(function () {
    $('#user-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: false,
      bSort: true,
      bFilter: false,
      bInfo: false,
      "iDisplayLength": 8,
      "bLengthChange": false,
    });
  });

  // User table
  $(function () {
    $('#list-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: true,
      bSort: true,
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 14,
      "bLengthChange": false,
    });
  });

  // User table
  $(function () {
    $('#booker-payments-table').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      paging: true,
      bSort: true,
      bFilter: true,
      bInfo: false,
      "iDisplayLength": 5,
      "bLengthChange": false,
    });
  });

  // Search table
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
})(jQuery);
