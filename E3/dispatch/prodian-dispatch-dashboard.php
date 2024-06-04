<?php
  include ('../../conn/connection.php');
?>
  <?php session_start();?>
  <?php include('../../partials/dispatch/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('../../partials/dispatch/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('../../partials/dispatch/sidebar.php');?>

  <script>
  var x = document.getElementById('dash')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Dispatching Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section">
      
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/dispatch/footer.php'); ?>
  <!-- End Footer -->

</html>