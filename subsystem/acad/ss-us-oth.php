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
  var x = document.getElementById('oth')
  x.className = "active";
  var x = document.getElementById('us')
  x.className = "active";
  var y = document.getElementById('ss')
  y.className = "nav-link ";
  var h = document.getElementById('ss-nav')
  h.className = "nav-content collapse show";
  var h = document.getElementById('sm1')
  h.className = "collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Used Assets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item active"><a href="ss-us.php">Used Assets</a></li>
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
      <h5 class="card-title">Others List</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Image</th>
            <th scope="col">Requestor</th>
            <th scope="col">Position</th>
            <th scope="col">Assets</th>
            <th scope="col">Date of Used</th>
            <th scope="col">Action</th>
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
          $limit = 12; // Number of records per page
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $start = ($page - 1) * $limit;
    
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM ss_us WHERE a_name LIKE :search ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
          } else {
            $stmt = $conn->prepare("SELECT * FROM ss_us ORDER BY id ASC LIMIT :start, :limit");
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
          <td><?php echo $row['a_image'];?></td>
          <td><?php echo $row['rname'];?></td>
          <td><?php echo $row['rpos'];?></td>
          <td><?php echo $row['a_name'];?></td>
          <td><?php echo $row['date_used'];?></td>
          <td>
          <button class="btn btn-light border shadow-sm" data-toggle="tooltip" data-placement="top" title="View Assets">
            <a href="#view<?php echo $id;?>" data-bs-toggle="modal">
            <i class="bi bi-eye fa-lg" style="color:#256D85"></i></a>
          </button>
          <button class="btn btn-light border shadow-sm" data-toggle="tooltip" data-placement="top" title="Request Repair" onclick="approveConfirmation(<?php echo $id;?>)">
            <i class="bi bi-tools fa-lg" style="color:#256D85"></i>
          </button>
          <button class="btn btn-light border shadow-sm" data-toggle="tooltip" data-placement="top" title="Pull-out Assets">
            <a href="#po<?php echo $id;?>" data-bs-toggle="modal">
            <i class="bi bi-folder-symlink fa-lg" style="color:#256D85"></i></a>
          </button>
          </td>

          <!-- View Modal -->    
          <div class="modal fade" id="view<?php  echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">View Asset</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if($row['a_image'] != ""): ?>
                      <img src="assets/img/prodian/<?php echo $row['a_image']; ?>" width="450px" height="450px" style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
                    <?php else: ?>
                    <?php endif; ?>
                    <h5 class="card-title">Asset Details</h5>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label"><b>Request By:</b></div>
                      <div class="col-lg-4 col-md-8"><?php echo $row['rname'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label"><b>Position:</b></div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['rpos'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label "><b>Request Asset:</b></div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['a_name'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label"><b>Date of used:</b></div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['date_used'];?></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>  
          
          <!-- Request Swal -->
          <script>
            function approveConfirmation(id) {
              Swal.fire({
                title: 'Confirm Request?',
                text: 'Are you sure to this request?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, request it!',
                cancelButtonText: 'Not yet'
              }).then((result) => {
                if (result.value) {
                  window.location.href = 'action/request/req-repair.php?id=' + id;
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
          $stmt = $conn->prepare("SELECT COUNT(*) FROM ss_us WHERE s_name LIKE :search OR category LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM ss_us");
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