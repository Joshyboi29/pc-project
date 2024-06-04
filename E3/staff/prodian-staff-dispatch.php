<?php
  include ('conn/connection.php');
?>
  <?php session_start();?>
  <?php include('partials/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('partials/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('partials/sidebar.php');?>

  <script>
  var x = document.getElementById('dispatch')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Dispatch</h1>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
      <div class="card-body">
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addassets"><i class="bi bi-plus-lg fa-lg"></i>
        Add Assets
        </button>
        <h5 class="card-title">Assets List</h5>

      </div>
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('partials/footer.php'); ?>
  <!-- End Footer -->

</html>