<?php
  include ('../../conn/connection.php');
?>
  <?php session_start();?>
  <?php include('../../partials/admin/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('../../partials/admin/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('../../partials/admin/sidebar.php');?>

  <script>
  var x = document.getElementById('dash')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Admin Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Request Card -->
            <?php
            $select = $conn->prepare("SELECT (
                                    (SELECT count(id) as a FROM arm_req_ssa) +
                                    (SELECT count(id) as b FROM arm_req_ta))
                                    as t");
            $select->execute();
            $row=$select->fetch(PDO::FETCH_OBJ);
            $total = $row->t;
            ?>      
                
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card request-card">
                <div class="card-body">
                  <h5 class="card-title">Total Request</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $row->t?> Request</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Request Card -->

            <!-- Assets Card -->
            <?php
            $select = $conn->prepare("SELECT (
                                    (SELECT count(id) as a FROM inventory_ssa) +
                                    (SELECT count(id) as b FROM inventory_ta_eq) +
                                    (SELECT count(id) as c FROM inventory_ta_blg) +
                                    (SELECT count(id) as c FROM inventory_ta_fnt))
                                    as t");
            $select->execute();
            $row=$select->fetch(PDO::FETCH_OBJ);
            $total = $row->t;
            ?>     

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card assets-card">
                <div class="card-body">
                  <h5 class="card-title">Total Assets</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $row->t?> Assets</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Assets Card -->

            <!-- Dispose Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card dispose-card">
                <div class="card-body">
                  <h5 class="card-title">Total Dispose</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-trash"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0 Dispose</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Dispose Card -->

                        <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Request',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Assets',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Dispose',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

        </div><!-- End Left side columns -->
        </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/admin/footer.php'); ?>
  <!-- End Footer -->

</html>