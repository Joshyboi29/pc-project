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
  var x = document.getElementById('ra')
  x.className = "active";
  var y = document.getElementById('ss')
  y.className = "nav-link ";
  var h = document.getElementById('ss-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Receiving Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item active"><a href="ss-req-ra.php">Received Request</a></li>
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
            <th scope="col">Confirmation</th>
          </tr>
      </thead>
      <tbody>
      <!-- Confirmation Swal -->
      <script>
        <?php
          if (isset($_SESSION['confirmation']) && $_SESSION['confirmation'] == 1) {
        ?>
          Swal.fire({
            title: "Thank you!",
            text: "Please request again if you need assets.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['confirmation']);
          }
        ?>
      </script> 
      <?php
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $tables = ['dispatch_dp_oth_done', 'dispatch_dp_sa_done', 'arm_req_rec_ssa', 'arm_req_rec_oth_dp'];
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
            if ($table == 'arm_req_rec_ssa' || $table == 'arm_req_rec_oth_dp') {
              echo "<td><span style='font-size: .70em; padding: 0.75em 1.25em;' class='badge bg-success text-white'>Delivered</span></td>";
            } else {
              echo "<td><span style='font-size: .70em; padding: 0.75em 1.25em;' class='badge bg-warning text-dark'>In-Process</span></td>";
            }
            echo "<td>";
            if ($table == 'arm_req_rec_ssa') {
              echo "<button class='btn btn-light border shadow-sm' style='width: 125px; height: 40px; color: green;' onclick='Confirmation(" . $id . ")'><i class='bi bi-folder-check' style='color: green;'></i> Received</button>";
            } else if ($table == 'arm_req_rec_oth_dp') {
              echo "<button class='btn btn-light border shadow-sm' style='width: 125px; height: 40px; color: green;' onclick='aConfirmation(" . $id . ")'><i class='bi bi-folder-check' style='color: green;'></i> Received</button>";
            } 
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
      <!-- Confirmation Swal -->
      <script>
        function Confirmation(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: 'Do you sure that you have received your request?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, I received it!',
            cancelButtonText: 'Not yet'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'action/received/ss-req-rec-sa.php?id=' + id;
            }
          })
        }
      </script>

      <!-- Confirmation Swal -->
      <script>
        function aConfirmation(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: 'Do you sure that you have received your request?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, I received it!',
            cancelButtonText: 'Not yet'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'action/received/ss-req-rec-oth.php?id=' + id;
            }
          })
        }
      </script>
      </tbody>
    </table>
    </div>
    <?php
        // Retrieve the total number of rows that match the search criteria
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM arm_req_ta WHERE req_name LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM arm_req_ta");
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
              <a class="page-link" href="prodian-arm-ar.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
          <?php for($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
              <a class="page-link" href="prodian-arm-ar.php?page=<?php echo $i; ?>">
                <?php echo $i; ?>
              </a>
            </li>
          <?php } ?>
            <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
              <a class="page-link" href="prodian-arm-ar.php?page=<?php echo $page+1; ?>" aria-label="Next">
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