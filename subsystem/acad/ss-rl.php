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
  var x = document.getElementById('ar')
  x.className = "active";
  var x = document.getElementById('rl')
  x.className = "active";
  var y = document.getElementById('ss')
  y.className = "nav-link ";
  var h = document.getElementById('ss-nav')
  h.className = "nav-content collapse show";
  var h = document.getElementById('sm')
  h.className = "collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item active"><a href="ss-rl.php">Requests</a></li>
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
            <th scope="col">Requestor</th>
            <th scope="col">Position</th>
            <th scope="col">Request Assets</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
      <?php
        if (isset($_SESSION['delete']) && $_SESSION['delete'] == 1) {
          echo '
          <script>
            Swal.fire({
              title: "Deleted!",
              text: "Successfully Delete",
              icon: "success",
              confirmButtonText: "OK"
            });
          </script>
          ';
          unset($_SESSION['delete']);
        }
      ?>
      <?php
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $tables = ['arm_req_ta', 'arm_req_ssa', 'arm_req_rej'];
        $count = 0;

        foreach ($tables as $table) {
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM $table WHERE a_name LIKE :search ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
          } else {
            $stmt = $conn->prepare("SELECT * FROM $table ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
          }
          $count += $stmt->rowCount();

          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $id=$row['id'];
            echo "<tr class='align=middle text-secondary text-center'>";
            echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
            echo "<td>" . $row['position'] . "</td>";
            echo "<td>" . $row['a_name'] . "</td>";
            echo "<td>" . $row['a_qty'] . "</td>";
            if ($table == 'arm_req_rej') {
              echo "<td><span style='font-size: .70em; padding: 0.75em 1.25em;' class='badge bg-danger text-white'>Rejected</span></td>";
            } else {
              echo "<td><span style='font-size: .70em; padding: 0.75em 1.25em;' class='badge bg-warning text-dark'>Pending</span></td>";
            }
            echo "<td>";
            if ($table == 'arm_req_rej') {
              echo "<button class='btn btn-light border shadow-sm' style='color: Red; width: 95px; height: 40px;' onclick='deleteConfirmation(" . $id . ")'>";
              echo "<i class='bi bi-x-lg' style='color: Red;'></i> Delete</a>";
              echo "</button>";
            } else {
              echo "";
            }
            echo "</button>";
            echo "</td>";
            echo "</tr>";

          }
        }

        if($count == 0) {
          echo "<tr align=middle text-secondary text-center>";
          if(isset($_POST['search'])) {
            echo "<td colspan='7' style='text-align:center;'>No results found for '" . $_POST['search'] . "'</td>";
          } else {
            echo "<td colspan='7' style='text-align:center;'>No Available Request</td>";
          }
          echo "</tr>";
        }  
      ?>

      <!-- Delete Swal -->
      <script>
        function deleteConfirmation(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'action/delete/ss-delete-req-ssa.php?id=' + id;
            }
          })
        }
      </script>

      </tbody>
    </table>
    </div>
    <?php
      $tables = ['arm_req_ta', 'arm_req_ssa', 'arm_req_rej'];
      
      foreach($tables as $table) {
          // Retrieve the total number of rows that match the search criteria
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT COUNT(*) FROM $table WHERE a_name LIKE :search");
            $stmt->bindParam(':search', $search);
            $stmt->execute();
            $total_records = $stmt->fetchColumn();
          } else {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM $table");
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
                <a class="page-link" href="ss-rl.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
            <?php for($i = 1; $i <= $total_pages; $i++) { ?>
              <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
                <a class="page-link" href="ss-rl.php?page=<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              </li>
            <?php } ?>
              <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
                <a class="page-link" href="ss-rl.php?page=<?php echo $page+1; ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
            </nav>
          <?php
            }
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