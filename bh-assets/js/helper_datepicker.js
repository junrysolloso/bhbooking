$(document).ready(function () {

  if ($('#reportrange').length) {
    var start = moment().subtract(29, 'days');
    var end = moment();
    var ranges = 'This Month';

    function cb(start, end, ranges) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#dateRange').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      // dRequest($('input[name="dateRange"]').val(), false, ranges);
    }

    $('#reportrange').daterangepicker({
      opens: 'right',
      drops: 'down',
      startDate: start,
      endDate: end,
      ranges: {
        'This Week': [moment().startOf('week'), moment().endOf('week')],
        'Last Week': [moment().subtract(6, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
      }
    }, cb);
    cb(start, end, ranges);
  }

});