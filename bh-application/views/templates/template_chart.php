  <div class="content-area">
    <div class="page-header">
      <div class="info-section">
        <div class="d-flex align-items-center mb-2">
          <h4 class="page-title">Hi, welcome back!</h4>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="reportSummary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekly</button>
            <div class="dropdown-menu" aria-labelledby="reportSummary">
              <a class="dropdown-item" id="weekly" href="#">Weekly</a>
              <a class="dropdown-item" id="monthly" href="#">Monthly</a>
            </div>
          </div>
        </div>
        <p class="mb-3 mb-md-0">Your point of sale management dashboard.</p>
      </div>
    </div>

    <div class="content-area-inner">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><span id="fLabel">WEEKLY</span> SALES REPORT</h4>
              <div class="row">
                <div class="col-md-9 d-flex flex-column">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <div class="wrapper d-flex">
                    <div class="d-flex align-items-center m-3">
                      <span class="dot-indicator bg-info"></span>
                      <p class="mb-0 ml-2">GROCERY</p>
                    </div>
                    <div class="d-flex align-items-center mr-3">
                      <span class="dot-indicator bg-success"></span>
                      <p class="mb-0 ml-2">PHARMACY</p>
                    </div>
                    <div class="d-flex align-items-center m-3">
                      <span class="dot-indicator bg-warning"></span>
                      <p class="mb-0 ml-2">BEAUTY PRODUCTS</p>
                    </div>
                  </div>
                  <canvas class="pt-4 mt-auto chartjs-render-monitor" height="371" id="product-sales-chart"
                    style="display: block; height: 371px; width: 724px;" width="651"></canvas>
                </div>
                <div class="col-md-3 pl-4 pr-4 mt-4 pt-4 mt-md-0">
                  <div class="wrapper border-bottom mb-5 pb-5">
                    <div class="d-flex justify-content-between">
                      <h4 class="font-weight-semibold">₱<?php echo number_format( $daily_grocery, 2 ); ?></h4>
                    </div>
                    <p class="text-muted font-weight-medium">Daily Sales (GROCERY)</p>
                  </div>
                  <div class="wrapper border-bottom mb-5 pb-5 pt-2">
                    <div class="d-flex justify-content-between">
                      <h4 class="font-weight-semibold">₱<?php echo number_format( $daily_pharmacy, 2 ); ?></h4>
                    </div>
                    <p class="text-muted font-weight-medium">Daily Sales (PHARMACY)</p>
                  </div>
                  <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <h4 class="font-weight-semibold">₱<?php echo number_format( $daily_beauty, 2 ); ?></h4>
                    </div>
                    <p class="text-muted font-weight-medium">Daily Sales (BEAUTY)</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
