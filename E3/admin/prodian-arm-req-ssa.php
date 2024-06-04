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
  var x = document.getElementById('ar')
  x.className = "active";
  var x = document.getElementById('ssa')
  x.className = "active";
  var y = document.getElementById('arm')
  y.className = "nav-link ";
  var h = document.getElementById('arm-nav')
  h.className = "nav-content collapse show";
  var h = document.getElementById('sm')
  h.className = "collapse show";
  </script>
  <!-- End Sidebar-->


  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Supplies Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item"><a href="#">Request Assets</a></li>
          <li class="breadcrumb-item active"><a href="#">Other Request</a></li>
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
            <th scope="col">Name</th>
            <th scope="col">Position</th>
            <th scope="col">Department</th>
            <th scope="col">Request Assets</th>
            <th scope="col">Qty</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
      <!-- Approve Swal -->
      <script>
        <?php
          if (isset($_SESSION['approved']) && $_SESSION['approved'] == 1) {
        ?>
          Swal.fire({
            title: "Approved!",
            text: "The item has been approved.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['approved']);
          }
        ?>
      </script> 
      <!-- Reject Swal -->      
      <script>
        <?php
          if (isset($_SESSION['reject']) && $_SESSION['reject'] == 1) {
        ?>
          Swal.fire({
            title: "Rejected!",
            text: "The item has been reject.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['reject']);
          }
        ?>
      </script>       
      <?php  
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;
  
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT * FROM arm_req_ssa WHERE name LIKE :search ORDER BY id ASC LIMIT :start, :limit");
          $stmt->bindParam(':search', $search);
          $stmt->bindParam(':start', $start, PDO::PARAM_INT);
          $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
          $stmt->execute();
          $count = $stmt->rowCount();
        } else {
          $stmt = $conn->prepare("SELECT * FROM arm_req_ssa ORDER BY id ASC LIMIT :start, :limit");
          $stmt->bindParam(':start', $start, PDO::PARAM_INT);
          $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
          $stmt->execute();
          $count = $stmt->rowCount();
        }
        if($count == 0) {
            echo "<tr align=middle text-secondary text-center>";
            if(isset($_POST['search'])) {
                echo "<td colspan='6' style='text-align:center;'>No results found for '" . $_POST['search'] . "'</td>";
            } else {
                echo "<td colspan='6' style='text-align:center;'>No Available Request</td>";
            }
            echo "</tr>";
        } else {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $id=$row['id'];
        $year = date("Y");
      ?>
      
      <tr class="align=middle text-secondary text-center">
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
        <td><?php echo $row['position'];?></td>
        <td><?php echo $row['dept'];?></td>
        <td ><?php echo $row['a_name'];?></td>
        <td><?php echo $row['a_qty'];?></td>
        <td>
        <button class="btn btn-light border shadow-sm" style="width: 115px; height: 35px;" onclick="approveConfirmation(<?php echo $id;?>)">
          <a style="Color: Green"><i class="bi bi-check-circle"></i> Approve</a> 
        </button>
        <button class="btn btn-light border shadow-sm" style="width: 115px; height: 35px;" onclick="rejectConfirmation(<?php echo $id;?>)">
          <a style="Color: Red"><i class="bi bi-x-circle"></i> Decline</a> 
        </button>
        </td>

        <!-- Approve Swal -->
        <script>
          function approveConfirmation(id) {
            Swal.fire({
              title: 'Confirm Approve?',
              text: 'Do you want to approve this request?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, approve it!',
              cancelButtonText: 'Not yet'
            }).then((result) => {
              if (result.value) {
                window.location.href = '../../action/admin/approve/approve-req-ssa.php?id=' + id;
              }
            })
          }
        </script>

        <!-- Reject Swal -->
        <script>
          function rejectConfirmation(id) {
            Swal.fire({
              title: 'Confirm Reject?',
              text: 'Do you want to reject this request?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, reject it!',
              cancelButtonText: 'Not yet'
            }).then((result) => {
              if (result.value) {
                window.location.href = '../../action/admin/reject/reject-req-ssa.php?id=' + id;
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
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM arm_req_ssa WHERE req_name LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM arm_req_ssa");
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
              <a class="page-link" href="prodian-arm-req-ssa.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
          <?php for($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
              <a class="page-link" href="prodian-arm-req-ssa.php?page=<?php echo $i; ?>">
                <?php echo $i; ?>
              </a>
            </li>
          <?php } ?>
            <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
              <a class="page-link" href="prodian-arm-req-ssa.php?page=<?php echo $page+1; ?>" aria-label="Next">
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
  <?php include ('../../partials/admin/footer.php'); ?>
  <!-- End Footer -->

</html>