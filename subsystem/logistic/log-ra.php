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
  var y = document.getElementById('ra')
  y.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Request Assets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="log-ra.php">Request Assets</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">  
      <h5 class="card-title">Request List</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Requestor</th>
            <th scope="col">Position</th>
            <th scope="col">Asset Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date of Request</th>
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
        <?php  
          $limit = 5; // Number of records per page
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $start = ($page - 1) * $limit;
    
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM arm_req_rec_oth WHERE plate LIKE :search ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
          } else {
            $stmt = $conn->prepare("SELECT * FROM arm_req_rec_oth ORDER BY id ASC LIMIT :start, :limit");
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
          <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
          <td><?php echo $row['position'];?></td>
          <td><?php echo $row['a_name'];?></td>
          <td><?php echo $row['a_qty'];?></td>
          <td><?php echo $row['date'];?></td>
          <td>
          <button class="btn btn-light border shadow-sm" style="width: 115px; height: 35px;" onclick="approveConfirmation(<?php echo $id;?>)">
          <a style="Color: Green"><i class="bi bi-check-circle" style="Color: Green"></i> Approve</a> 
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
                window.location.href = 'action/approve/log-approve-ra.php?id=' + id;
              }
            })
          }
        </script>

        </tr>
    <?php }}?>
      </tbody>
    </table>
    </div>
    <?php
        // Retrieve the total number of rows that match the search criteria
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM arm_req_rec_oth WHERE s_name LIKE :search OR category LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM arm_req_rec_oth");
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