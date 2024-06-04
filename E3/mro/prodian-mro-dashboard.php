<?php
  include ('../../conn/connection.php');
?>
  <?php session_start();?>
  <?php include('../../partials/mro/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('../../partials/mro/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('../../partials/mro/sidebar.php');?>

  <script>
  var x = document.getElementById('dash')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>MRO Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Request Card -->
        <?php
        $select = $conn->prepare("SELECT (
                                (SELECT count(id) as b FROM mro_repair_request))
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
                  <i class="ri-folder-add-line"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $row->t?> Repair Request</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Request Card -->

        <!-- Assets Card -->
        <?php
        $select = $conn->prepare("SELECT (
                                (SELECT count(id) as c FROM mro_checkup))
                                as t");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->t;
        ?>     

        <div class="col-xxl-4 col-md-4">
          <div class="card info-card assets-card">
            <div class="card-body">
              <h5 class="card-title">Total Checking</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-clipboard-check"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $row->t?> Checking Assets</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Assets Card -->

        <!-- Dispose Card -->

        <?php
        $select = $conn->prepare("SELECT (
                                (SELECT count(id) as c FROM mro_repaired))
                                as t");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->t;
        ?>     

        <div class="col-xxl-4 col-md-4">
          <div class="card info-card dispose-card">
            <div class="card-body">
              <h5 class="card-title">Total Repaired</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-tools"></i>
                </div>
                <div class="ps-3">
                <h6><?php echo $row->t?> Repaired Assets</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Dispose Card -->
      </div><!-- End Left side columns -->
      </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/mro/footer.php'); ?>
  <!-- End Footer -->

</html>