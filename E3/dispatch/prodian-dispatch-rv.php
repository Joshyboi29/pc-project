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
  var x = document.getElementById('rv')
  x.className = "active";
  var y = document.getElementById('vcl')
  y.className = "nav-link ";
  var h = document.getElementById('vcl-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Vehicles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Vehicles</a></li>
          <li class="breadcrumb-item active"><a href="prodian-dispatch-rv.php">Request Vehicle</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">
      <div class="search-bar">
        <form class="search-form d-flex align-items-center" id="search-form" method="POST" action="">
          <input type="text" name="search" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search fs-5" style="color: #256D85"></i></button>
        </form>
      </div>
      <li class="d-block d-lg-none">
      <a class="search-bar-toggle" href="#">
        <i class="bi bi-search fs-3"></i>
      </a>
      </li>
      <h5 class="card-title">Request List</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Image</th>
            <th scope="col">Plate #</th>
            <th scope="col">Vehicle Brand</th>
            <th scope="col">Vehicle Type</th>
            <th scope="col">Status</th>
          </tr>
      </thead>
      <tbody>
      <?php  
        $limit = 5; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT * FROM dispatch_vcl_rv WHERE plate LIKE :search OR type LIKE :search ORDER BY id ASC LIMIT :start, :limit");
          $stmt->bindParam(':search', $search);
          $stmt->bindParam(':start', $start, PDO::PARAM_INT);
          $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
          $stmt->execute();
          $count = $stmt->rowCount();
        } else {
          $stmt = $conn->prepare("SELECT * FROM dispatch_vcl_rv ORDER BY id ASC LIMIT :start, :limit");
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
                echo "<td colspan='7' style='text-align:center;'>No request</td>";
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
        <td><span style="font-size: .70em; padding: 0.75em 1.25em;" class="badge bg-warning text-dark">Pending</span></td>
      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <?php
      // Retrieve the total number of rows that match the search criteria
      if(isset($_POST['search'])) {
        $search = "%" . $_POST['search'] . "%";
        $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_vcl_rv WHERE plate LIKE :search OR type LIKE :search");
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        $total_records = $stmt->fetchColumn();
      } else {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_vcl_rv");
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
          <a class="page-link" href="prodian-dispatch-rv.php?page=<?php echo $page-1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php for($i = 1; $i <= $total_pages; $i++) { ?>
        <li class="page-item <?php if($page == $i) { echo 'active'; } ?>" style="<?php if($page == $i) { echo 'color: black;'; } ?>">
          <a class="page-link" href="prodian-dispatch-rv.php?page=<?php echo $i; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php } ?>
        <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-dispatch-rv.php?page=<?php echo $page+1; ?>" aria-label="Next">
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
  <?php include ('../../partials/dispatch/footer.php'); ?>
  <!-- End Footer -->

</html>