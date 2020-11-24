(function ($) {
  'use strict';
  $(function () {

    var ChartColor = ["#911a6c", "#d41459", "#EF726F", "#F9C446", "rgb(93.0, 98.0, 180.0)", "#21B7EC", "#04BCCC"];
    var chartFontcolor = '#6c757d';
    var chartGridLineColor = 'rgba(0,0,0,0.08)';

    var labels = [];
    var totals = [];

    $('.g-labels').each(function(i){
      labels[i] = $(this).val();
    });

    $('.g-totals').each(function(i){
      totals[i] = $(this).val();
    });

    if ($("#mixed-chart").length) {
      var chartData = {
        labels: labels,
        datasets: [{
          type: 'bar',
          label: 'Payment Recieved',
          data: totals,
          backgroundColor: ChartColor[0],
          borderColor: ChartColor[0],
          borderWidth: 2
        }]
      };
      var MixedChartCanvas = document.getElementById('mixed-chart').getContext('2d');
      var lineChart = new Chart(MixedChartCanvas, {
        type: 'bar',
        data: chartData,
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'Payment recieved each year',
            fontColor: chartFontcolor
          },
          scales: {
            xAxes: [{
              display: true,
              ticks: {
                fontColor: chartFontcolor,
                stepSize: 50,
                min: 0,
                max: 150,
                autoSkip: true,
                autoSkipPadding: 15,
                maxRotation: 0,
                maxTicksLimit: 10
              },
              gridLines: {
                display: false,
                drawBorder: false,
                color: chartGridLineColor,
                zeroLineColor: chartGridLineColor
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: '',
                fontSize: 12,
                lineHeight: 2,
                fontColor: chartFontcolor
              },
              ticks: {
                fontColor: chartFontcolor,
                display: true,
                autoSkip: false,
                maxRotation: 0,
                stepSize: 10000,
                min: 0,
                max: 100000
              },
              gridLines: {
                drawBorder: false,
                color: chartGridLineColor,
                zeroLineColor: chartGridLineColor
              }
            }]
          },
          legend: {
            display: false
          },
          legendCallback: function (chart) {
            var text = [];
            text.push('<div class="chartjs-legend d-flex justify-content-center mt-4"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              // console.log(chart.data.datasets[i]);
              text.push('<li>');
              text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
              text.push(chart.data.datasets[i].label);
              text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
          }
        }
      });
      document.getElementById('mixed-chart-legend').innerHTML = lineChart.generateLegend();
    }
  });
})(jQuery)