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
  var x = document.getElementById('vl')
  x.className = "active";
  var y = document.getElementById('ss')
  y.className = "nav-link ";
  var h = document.getElementById('ss-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Vehicle Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Vehicle Management</a></li>
          <li class="breadcrumb-item active"><a href="ss-rl.php">Vehicle List</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">
      <h5 class="card-title">Available Vehicles</h5>
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
      <!-- Request Swal -->
      <?php
        if (isset($_SESSION['request']) && $_SESSION['request'] == 1) {
          echo '
          <script>
            Swal.fire({
              title: "Requested!",
              text: "The vehicle has been requested.",
              icon: "success",
              confirmButtonText: "OK"
            });
          </script>
          ';
          unset($_SESSION['request']);
        }
      ?>
      <?php  
        $limit = 5; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $stmt = $conn->prepare("SELECT * FROM dispatch_vcl_vl ORDER BY id ASC LIMIT :start, :limit");
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
        <button class="btn btn-light border shadow-sm">
          <a href="#update<?php echo $id;?>" data-bs-toggle="modal">
          <i class="bi bi-pencil-square fa-lg" style="color:#256D85"></i></a>
        </button>
        <button class="btn btn-light border shadow-sm" onclick="deleteConfirmation(<?php echo $id;?>)">
          <i class="bi bi-trash fa-lg" style="color:#256D85"></i>
        </button>
        </td>

        <!-- Confirmation Swal -->
        <script>
          function Confirmation(id) {
            Swal.fire({
              title: 'Confirm Request?',
              text: 'Do you want to request vehicle?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, request it!',
              cancelButtonText: 'Not yet'
            }).then((result) => {
              if (result.value) {
                window.location.href = '../../action/dispatch/request/dispatch-req-vcl.php?id=' + id;
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
      $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_vcl_vl");
      $stmt->execute();
      $total_records = $stmt->fetchColumn();
      
      $total_pages = ceil($total_records / $limit);
      
      if($total_pages > 1) {
      ?>
      <nav style="float: right; margin-top: 5px">
      <ul class="pagination">
        <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-dispatch-vl.php?page=<?php echo $page-1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php for($i = 1; $i <= $total_pages; $i++) { ?>
        <li class="page-item <?php if($page == $i) { echo 'active'; } ?>" style="<?php if($page == $i) { echo 'color: black;'; } ?>">
          <a class="page-link" href="prodian-dispatch-vl.php?page=<?php echo $i; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php } ?>
        <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-dispatch-vl.php?page=<?php echo $page+1; ?>" aria-label="Next">
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
  <?php include ('partials/footer.php'); ?>
  <!-- End Footer -->

</html>