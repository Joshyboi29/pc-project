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
  var x = document.getElementById('dash')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section">
      
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('partials/footer.php'); ?>
  <!-- End Footer -->

</html>