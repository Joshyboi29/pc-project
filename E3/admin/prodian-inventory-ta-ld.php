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
  var x = document.getElementById('ta1')
  x.className = "active";
  var x = document.getElementById('ld')
  x.className = "active";
  var y = document.getElementById('inv')
  y.className = "nav-link ";
  var h = document.getElementById('inventory-nav')
  h.className = "nav-content collapse show";
  var h = document.getElementById('sm1')
  h.className = "collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Tangible Assets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Inventory</a></li>
          <li class="breadcrumb-item active"><a href="#">Tangible Assets</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
      <div class="card-body">
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addassets"><i class="ri-add-fill ri-2x"></i>
        </button>
        <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="search" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search fs-5" style="color: #256D85"></i></button>
          </form>
        </div>
        <li class="d-block d-lg-none">
          <a class="search-bar-toggle" href="#">
            <i class="bi bi-search fs-3"></i>
          </a>
        </li>
        <h5 class="card-title">Assets List</h5>
        <div class="modal fade" id="addassets" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Assets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="action/add/prodian-add-ta-blg.php" enctype="multipart/form-data" class="row g-3">
                  <div class="col-md-12">
                    <span>Select image:</span>
                    <input type="file" name="image"class="form-control">
                  </div>
                  <div class="col-md-12">
                    <span>Building Name:</span>
                    <input type="text" name="building"class="form-control" placeholder="Building Name">
                  </div>
                  <div class="col-md-12">
                    <span>Address:</span>
                    <input type="text" name="address"class="form-control" placeholder="Address">
                  </div>
                  <div class="col-md-12">
                    <span>Date of Construction:</span>
                    <input type="date" name="dateofcons"class="form-control" placeholder="Date of Construction">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add" value="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

      </div>
      </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/admin/footer.php'); ?>
  <!-- End Footer -->

</html>