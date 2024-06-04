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
  var y = document.getElementById('bv')
  y.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Vehicles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Vehicles</a></li>
          <li class="breadcrumb-item active"><a href="prodian-dispatch-vl.php">Borrowed Vehicle</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">
      <h5 class="card-title">Borrowed Vehicles</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Image</th>
            <th scope="col">Plate #</th>
            <th scope="col">Vehicle Brand</th>
            <th scope="col">Vehicle Type</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
      <?php  
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $stmt = $conn->prepare("SELECT * FROM dispatch_vcl_bv ORDER BY id ASC LIMIT :start, :limit");
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0) {
            echo "<tr align=middle text-secondary text-center>";
                echo "<td colspan='7' style='text-align:center;'>No available vehicle</td>";
            echo "</tr>";
        } else {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $id=$row['id'];
      ?>
      
      <tr class="align=middle text-secondary text-center">
        <td><img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" height="70px" width="70px"></td>
        <td><?php echo $row['plate'];?></td>
        <td><?php echo $row['vbrand'];?></td>
        <td><?php echo $row['type'];?></td>
        <td>        
        <button class="btn btn-light border shadow-sm" style="width: 110px; height: 40px;" onclick="approveConfirmation(<?php echo $id;?>)">
        <a style="Color: Green"><i class="bx bx-car"></i> Return</a>
        </button></td>
      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <?php
      // Retrieve the total number of rows that match the search criteria
      $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_vcl_bv");
      $stmt->execute();
      $total_records = $stmt->fetchColumn();
        
      $total_pages = ceil($total_records / $limit);

      if($total_pages > 1) {
    ?>
      <nav style="float: right; margin-top: 5px">
      <ul class="pagination">
        <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-staff-req-ssa.php?page=<?php echo $page-1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php for($i = 1; $i <= $total_pages; $i++) { ?>
        <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
          <a class="page-link" href="prodian-staff-req-ssa.php?page=<?php echo $i; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php } ?>
        <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-staff-req-ssa.php?page=<?php echo $page+1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
      </nav>
    <?php
      }
    ?>
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/dispatch/footer.php'); ?>
  <!-- End Footer -->

</html>