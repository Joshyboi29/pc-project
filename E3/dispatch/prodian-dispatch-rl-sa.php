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
  var x = document.getElementById('rl')
  x.className = "active";
  var y = document.getElementById('dp')
  y.className = "nav-link ";
  var h = document.getElementById('dp-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Request List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Request List</a></li>
          <li class="breadcrumb-item active"><a href="prodian-dispatch-rl-sa.php">Supplies</a></li>
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
      <h5 class="card-title">All Request</h5>
      <div class="card-body asset-list overflow-auto">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="prodian-dispatch-rl-sa.php" role="tab" aria-selected="true">Supplies</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="prodian-dispatch-rl-oth.php" role="tab" aria-selected="false" style="color: #256D85;">Others</a>
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
      <script>
        <?php
          if (isset($_SESSION['dispatch']) && $_SESSION['dispatch'] == 1) {
        ?>
          Swal.fire({
            title: "Assets Dispatch!",
            text: "The assets has been ready for dispatching.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['dispatch']);
          }
        ?>
      </script> 
      <?php  
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;
  
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT * FROM dispatch_dp_sa WHERE name LIKE :search ORDER BY id ASC LIMIT :start, :limit");
          $stmt->bindParam(':search', $search);
          $stmt->bindParam(':start', $start, PDO::PARAM_INT);
          $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
          $stmt->execute();
          $count = $stmt->rowCount();
        } else {
          $stmt = $conn->prepare("SELECT * FROM dispatch_dp_sa ORDER BY id ASC LIMIT :start, :limit");
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
                echo "<td colspan='7' style='text-align:center;'>No Available Request</td>";
            }
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
        <button class="btn btn-light border shadow-sm" style="width: 120px; height: 40px;">
        <a href="#dispatch<?php echo $id;?>" data-bs-toggle="modal" style="Color: #256D85"><i class="bi bi-truck"></i> Dispatch</a>
        </button>
        </td>
      <!-- Dispatch Modal -->
      <div class="modal fade" id="dispatch<?php  echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Dispatching :</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="../../action/dispatch/dispatching/prodian-dp-sa.php<?php echo '?id='.$id; ?>" enctype="multipart/form-data" class="row g-12">
              <div class="row mb-3">
              <label for="fullname" class="col-md-4 col-lg-3 col-form-label">Requestor Name :</label>
                <div class="col-md-8 col-lg-9">
                  <div class="form-group d-flex">
                    <input type="fname" class="form-control mr-2" name="fname" value="<?php echo $row['fname'];?>" disabled>
                    <input type="hidden" name="fname" value="<?php echo $row['fname'];?>">
                    <input type="lname" class="form-control" name="lname" value="<?php echo $row['lname'];?>" disabled>
                    <input type="hidden" name="lname" value="<?php echo $row['lname'];?>">
                  </div>
                </div>
              </div>

              <div class="row mb-3">
              <label for="position" class="col-md-4 col-lg-3 col-form-label">Requestor Position :</label>
                <div class="col-md-8 col-lg-9">
                  <input name="position" type="text" class="form-control" value="<?php echo $row['position'];?>" disabled>
                  <input type="hidden" name="position" value="<?php echo $row['position'];?>">
                </div>
              </div>

              <div class="row mb-3">
              <label for="dept" class="col-md-4 col-lg-3 col-form-label">Department :</label>
                <div class="col-md-8 col-lg-9">
                  <input name="dept" type="text" class="form-control"value="<?php echo $row['dept'];?>" disabled>
                  <input type="hidden" name="dept" value="<?php echo $row['dept'];?>">
                </div>
              </div>

              <div class="row mb-3">
              <label for="reqassets" class="col-md-4 col-lg-3 col-form-label">Requested Assets :</label>
                <div class="col-md-8 col-lg-9">
                  <input name="reqassets" type="text" class="form-control" value="<?php echo $row['a_name'];?>" disabled>
                  <input type="hidden" name="reqassets" value="<?php echo $row['a_name']; ?>">
                </div>
              </div>

              <div class="row mb-3">
              <label for="number" class="col-md-4 col-lg-3 col-form-label">Quantity :</label>
                <div class="col-md-8 col-lg-9">
                  <input name="qty" type="number" class="form-control" value="<?php echo $row['a_qty'];?>" disabled>
                  <input type="hidden" name="qty" value="<?php echo $row['a_qty']; ?>">
                </div>
              </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="dispatch" class="btn btn-success">Dispatch</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <?php
        // Retrieve the total number of rows that match the search criteria
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_dp_sa WHERE req_name LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_dp_sa");
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