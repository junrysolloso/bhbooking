(function ($) {
  'use strict';
  
  $(function () {
    var base_url = $('#base_url').val();
    var successColor = getComputedStyle(document.body).getPropertyValue('--success');
    var warningColor = getComputedStyle(document.body).getPropertyValue('--warning');
    var infoColor = getComputedStyle(document.body).getPropertyValue('--info');

    var lineChartCanvas = $("#product-sales-chart").get(0).getContext("2d");
    var gradientStrokeFill_1 = lineChartCanvas.createLinearGradient(0, 0, 0, 460);
    gradientStrokeFill_1.addColorStop(1, 'rgba(255, 255, 255, 0.0)');
    gradientStrokeFill_1.addColorStop(0, 'rgba(102, 78, 235, 0.2)');

    var gradientStrokeFill_2 = lineChartCanvas.createLinearGradient(0, 0, 0, 430);
    gradientStrokeFill_2.addColorStop(1, 'rgba(255, 255, 255, 0.0)');
    gradientStrokeFill_2.addColorStop(0, '#14c671');

    var gradientStrokeFill_3 = lineChartCanvas.createLinearGradient(0, 0, 0, 400);
    gradientStrokeFill_3.addColorStop(1, 'rgba(255, 255, 255, 0.0)');
    gradientStrokeFill_3.addColorStop(0, '#ffaf00');

    $('#weekly').on('click', function(){
      chart_data( 7, 'WEEKLY' );
    });

    $('#monthly').on('click', function(){
      chart_data( 30, 'MONTHLY' );
    });

    if ($('#product-sales-chart').length) {
      chart_data( 7, 'WEEKLY' );
    }

    function chart_data(limit, label) {
      $.ajax({
        type: 'GET',
        url: base_url + 'dashboard/sales?limit=' + parseInt( limit ),
        dataType: 'json',
        error: function(jqXHR){
          console.log(jqXHR.responseText);
        },
        success: function(data){
          $('#fLabel').text(label)
          populate_chart(data);
        } 
      });
    }

    function populate_chart(data) {
      var areaData = {
        labels: data.labels,
        datasets: [{
          label: 'Sales ₱',
          data: data.gTotal,
          borderColor: infoColor,
          backgroundColor: gradientStrokeFill_1,
          borderWidth: 2
        }, {
          label: 'Sales ₱',
          data: data.pTotal,
          borderColor: successColor,
          backgroundColor: gradientStrokeFill_2,
          borderWidth: 2
        }, {
          label: 'Sales ₱',
          data: data.bTotal,
          borderColor: warningColor,
          backgroundColor: gradientStrokeFill_3,
          borderWidth: 2
        }]
      };
      var areaOptions = {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        elements: {
          point: {
            radius: 3,
            backgroundColor: "#fff"
          },
          line: {
            tension: 0
          }
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        },
        legend: false,
        scales: {
          xAxes: [{
            ticks: {
              fontColor: "#858585",
              beginAtZero: true

            },
            gridLines: {
              color: '#fff',
              display: true,
              drawBorder: false
            }
          }],
          yAxes: [{
            ticks: {
              max: 10000,
              min: 0,
              stepSize: 1000,
              fontColor: "#858585",
              beginAtZero: false
            },
            gridLines: {
              color: '#e2e6ec',
              display: true,
              drawBorder: false
            }
          }]
        }
      }
      var revenueChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }
  });
})(jQuery)
