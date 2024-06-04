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
  var x = document.getElementById('ssa')
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
      <h1>Add New Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item "><a href="#">Request Assets</a></li>
          <li class="breadcrumb-item active"><a href="ss-req-ssa.php">Supplies Requests</a></li>
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
            <h5 class="card-title">Available Assets</h5>

          <!-- Request Swal -->
          <script>
            <?php
              if (isset($_SESSION['request']) && $_SESSION['request'] == 1) {
            ?>
              Swal.fire({
                title: "Request!",
                text: "The item has been request.",
                icon: "success",
                confirmButtonText: "OK"
              });
            <?php
                unset($_SESSION['request']);
              }
            ?>
          </script> 
            
          <?php
          $search_keyword = "";
          $page = 1;

          if (isset($_POST['search'])) {
              $search_keyword = $_POST['search'];
              if (isset($_GET['page'])) {
                  $page = $_GET['page'];
              }
          } else if (isset($_GET['page'])) {
              $page = $_GET['page'];
              if (isset($_POST['search'])) {
                  $search_keyword = $_POST['search'];
              }
          }

          $items_per_page = 8;
          $stmt = $conn->prepare("SELECT COUNT(*) FROM inventory_ssa WHERE a_name LIKE :search_keyword");
          $stmt->execute(array(':search_keyword' => "%$search_keyword%"));
          $number_of_rows = $stmt->fetchColumn();
          $total_pages = ceil($number_of_rows / $items_per_page);

          $start = ($page-1) * $items_per_page;

          $stmt = $conn->prepare("SELECT * FROM inventory_ssa WHERE a_name LIKE :search_keyword LIMIT $start, $items_per_page");
          $stmt->execute(array(':search_keyword' => "%$search_keyword%"));
          $row = $stmt->fetchAll();
          ?>
          <?php
          if ($number_of_rows <= 0) {
            echo "<div class='text-center mt-5'>No row found for '" . $search_keyword . "'.</div>";
          } else {
          ?>
          <div class="d-flex flex-wrap justify-content-center mt-3">
            <?php foreach ($row as $row) { ?>
              <div class="card mb-3 mx-3 col-sm-6 col-md-4 col-lg-3">
                <img src="assets/img/prodian/<?php echo $row['a_image']; ?>" class="card-img-top" style="height: 250px; width: 100%;" alt="Asset Image">
                <div class="card-body">
                  <h5 class="card-title text-center"><?php echo $row["a_name"]; ?></h5>
                  <p class="card-text text-center">Available Stocks: <?php echo $row['a_qty']; ?></p>
                  <button class="btn btn-success border shadow-sm" style="display: block; margin: 12px auto;">
                    <a href="#request<?php echo $row['id'];?>" data-bs-toggle="modal" style="color:White">Request</a>
                  </button>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="request<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="request<?php echo $row['id'];?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="request<?php echo $row['id'];?>">Confirm Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form id="myForm" action="action/add/ss-add-req-ssa.php" method="post">
                            <div class="modal-body">
                              <h5 class="card-title text-center">You want to Request <?php echo $row["a_name"]; ?> ?</h5>
                              <p class="card-text text-center">The Available Stocks of this assets is <b><?php echo $row['a_qty']; ?></b>.</p>
                              <div class="row mb-3">
                              <label for="types" class="col-md-4 col-lg-3 col-form-label"><b>Full Name</b></label>
                                <div class="col-md-8 col-lg-9">
                                  <div class="form-group d-flex">
                                    <input type="text" class="form-control mr-2" name="fname" placeholder="First name" required>
                                    <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                                  </div>
                                </div>
                              </div>                                
                              <div class="row mb-3">
                              <label for="types" class="col-md-4 col-lg-3 col-form-label"><b>Position</b></label>
                                <div class="col-md-8 col-lg-9">
                                <input name="position" type="text" class="form-control" id="position" placeholder="Position of Requestor" required>
                                </div>
                              </div>
                              <div class="row mb-3">
                              <label for="dept" class="col-md-4 col-lg-3 col-form-label"><b>Department</b></label>
                                <div class="col-md-8 col-lg-9">
                                  <select name="dept" class="form-select" required>
                                    <option value="Learning Management System">Choose...</option>
                                    <option value="Learning Management System">Learning Management System</option>
                                    <option value="Faculty Management Information System">Faculty Management Information System</option>
                                    <option value="Academic Management System">Academic Management System</option>
                                    <option value="Enrollment">Enrollment</option>
                                    <option value="Registrar">Registrar</option>
                                    <option value="Human Resource">Human Resource</option>
                                    <option value="Payment Management System">Payment Management System</option>
                                    <option value="Crad">Crad</option>
                                    <option value="Prefect Of Discipline">Prefect Of Discipline</option>
                                    <option value="Clinic">Clinic</option>
                                    <option value="Guidance">Guidance</option>
                                    <option value="Quality Assurance">Quality Assurance</option>
                                    <option value="Logistic Management System">Logistic Management System</option>
                                    <option value="Management Information System">Management Information System</option>
                                    <option value="Event Management System">Event Management System</option>
                                  </select>
                                </div>
                              </div>
                              <br><br>
                              <p class="card-text"><b>How many do you request?</b></p>
                              <div class="row mb-3">
                              <label for="qty" class="col-md-4 col-lg-3 col-form-label"><b>Request</b></label>
                                <div class="col-md-8 col-lg-9">
                                <input name="reqassets" type="text" class="form-control" id="assetname" value="<?php echo $row['a_name'];?>" readonly>
                                </div>
                              </div>
                              <div class="row mb-3">
                              <label for="qty" class="col-md-4 col-lg-3 col-form-label"><b>Quantity</b></label>
                                <div class="col-md-8 col-lg-9">
                                <input type="number" min="1" name="qty" class="form-control" id="qty" style="display: block; margin: 0 auto;">
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" name="request" class="btn btn-success" id="requestBtn">Request</button>
                            </div>
                          </form> 
                          
                      </div>
                  </div>
              </div>
            <?php } ?>
          </div>

          <?php
          }
          ?>
            <!-- Check if the total number of pages is greater than 1 -->
            <nav style="float: right; margin-top: 5px">
              <?php if($total_pages > 1): ?>
              <ul class="pagination">
                <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
                  <a class="page-link" href="ss-req-ssa.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                  <li class="page-item <?php if($page == $i) { echo 'active'; } ?>" style="<?php if($page == $i) { echo 'color: black;'; } ?>">
                    <a class="page-link" href="ss-req-ssa.php?page=<?php echo $i; ?>">
                      <?php echo $i; ?>
                    </a>
                  </li>
                  <?php } ?>
              <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
                <a class="page-link" href="ss-req-ssa.php?page=<?php echo $page+1; ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              </ul>
              <?php endif; ?>
            </nav>


		</div>
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('partials/footer.php'); ?>
  <!-- End Footer -->

</html>