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
  var x = document.getElementById('bv')
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
          <li class="breadcrumb-item active"><a href="ss-us.php">Borrowed Vehicles</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">  
      <h5 class="card-title">Borrowed vehicles</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Image</th>
            <th scope="col">Plate #</th>
            <th scope="col">Vehicle Brand</th>
            <th scope="col">Vehicle Type</th>
            <th scope="col">Borrowed By</th>
          </tr>
      </thead>
      <tbody>
      <!-- Request Swal -->
      <script>
        <?php
          if (isset($_SESSION['request']) && $_SESSION['request'] == 1) {
        ?>
          Swal.fire({
            title: "Requested!",
            text: "Your request have been sent.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['request']);
          }
        ?>
      </script> 
        <?php  
          $limit = 5; // Number of records per page
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $start = ($page - 1) * $limit;
    
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM dispatch_vcl_bv WHERE plate LIKE :search ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
          } else {
            $stmt = $conn->prepare("SELECT * FROM dispatch_vcl_bv ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
          }
          if($count == 0) {
              echo "<tr align=middle text-secondary text-center>";
              if(isset($_POST['search'])) {
                  echo "<td colspan='7' style='text-align:center;'>No results found for '" . $_POST['search'] . "'</td>";
              } else {
                  echo "<td colspan='7' style='text-align:center;'>No assets used</td>";
              }
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
          <td></td>
        </tr>
    <?php }}?>
      </tbody>
    </table>
    </div>
    <?php
        // Retrieve the total number of rows that match the search criteria
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_vcl_bv WHERE s_name LIKE :search OR category LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_vcl_bv");
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        }
        
        $total_pages = ceil($total_records / $limit);

        // Display the pagination links only if the search form has not been submitted
        if (empty($_POST['search'])){
          if($total_pages > 1) {
        ?>
        <nav style="float: right; margin-top: 5px">
        <ul class="pagination">
          <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
            <a class="page-link" href="ss-us.php?page=<?php echo $page-1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
          <li class="page-item <?php if($page == $i) { echo 'active'; } ?>" style="<?php if($page == $i) { echo 'color: black;'; } ?>">
            <a class="page-link" href="ss-us.php?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php } ?>
          <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
            <a class="page-link" href="ss-us.php?page=<?php echo $page+1; ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
        </nav>

        <?php
          }
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