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
  var x = document.getElementById('dp1')
  x.className = "active";
  var y = document.getElementById('dp')
  y.className = "nav-link ";
  var h = document.getElementById('dp-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dispatching</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="prodian-dispatch-dp.php">Dispatching</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">
      <h5 class="card-title">Asset List</h5>
      <div class="card-body asset-list overflow-auto">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="prodian-dispatch-dp-sa.php" role="tab" aria-selected="true" >Supplies</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="prodian-dispatch-dp-oth.php" role="tab" aria-selected="false" style="color: #256D85;">Others</a>
        </li>
      </ul>
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Requestor</th>
            <th scope="col">Position</th>
            <th scope="col">Department</th>
            <th scope="col">Request Assets</th>
            <th scope="col">Qty</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
      <!-- Delivered Swal -->
      <script>
        <?php
          if (isset($_SESSION['delivered']) && $_SESSION['delivered'] == 1) {
        ?>
          Swal.fire({
            title: "Procured!",
            text: "The assets request has been Procured.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['delivered']);
          }
        ?>
      </script> 
      <?php  
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $stmt = $conn->prepare("SELECT * FROM dispatch_dp_sa_done ORDER BY id ASC LIMIT :start, :limit");
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
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
        <td><?php echo $row['position'];?></td>
        <td><?php echo $row['dept'];?></td>
        <td><?php echo $row['a_name'];?></td>
        <td><?php echo $row['a_qty'];?></td>
        <td>
        <button class="btn btn-light border shadow-sm" style="width: 120px; height: 40px;" onclick="Confirmation(<?php echo $id;?>)">
          <a style="Color: #256D85"><i class="bi bi-check2-circle"></i> Procured</a>
        </button>
        </td>

        <!-- Approve Swal -->
        <script>
          function Confirmation(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: 'Do you sure that the assets has been Procured?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, Procured!',
              cancelButtonText: 'Not yet'
            }).then((result) => {
              if (result.value) {
                window.location.href = '../../action/dispatch/dispatching/prodian-dp-sa-done.php?id=' + id;
              }
            })
          }
        </script>
      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <?php
      // Retrieve the total number of rows that match the search criteria
      $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_dp_sa_done");
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