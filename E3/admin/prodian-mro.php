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
  var x = document.getElementById('mro')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Maintenance, Repair, Operations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="prodian-mro.php">M.R.O</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">  
      <h5 class="card-title">Repair Request List</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Requestor</th>
            <th scope="col">Position</th>
            <th scope="col">Department</th>
            <th scope="col">Name of Assets</th>
            <th scope="col">Date of Used</th>
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
          $page = isset($_GET['page1']) ? (int)$_GET['page1'] : 1;
          $start = ($page - 1) * $limit;

          $stmt = $conn->prepare("SELECT * FROM prodian_mro ORDER BY id ASC LIMIT :start, :limit");
          $stmt->bindParam(':start', $start, PDO::PARAM_INT);
          $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
          $stmt->execute();
          $count = $stmt->rowCount();

          if($count == 0) {
              echo "<tr align=middle text-secondary text-center>";
              echo "<td colspan='7' style='text-align:center;'>No request found</td>";
              echo "</tr>";
          } else {
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $id=$row['id'];
        ?>
        <tr class="align=middle text-secondary text-center" ondblclick="showModal(<?php echo $id;?>)">
          <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
          <td><?php echo $row['position'];?></td>
          <td><?php echo $row['dept'];?></td>
          <td><?php echo $row['a_name'];?></td>
          <td><?php echo $row['date_used'];?></td>
          <td>
          <button class="btn btn-light border shadow-sm" style="width: 125px; height: 35px;" onclick="approveConfirmation(<?php echo $id;?>)">
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
                window.location.href = '../../action/admin/approve/approve-req-mro.php?id=' + id;
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
                window.location.href = '../../action/admin/reject/reject-req-mro.php?id=' + id;
              }
            })
          }
        </script>
        </tr>
    <?php } }?>
      </tbody>
    </table>
    </div>
    <?php
    // Retrieve the total number of rows that match the search criteria
    $stmt = $conn->prepare("SELECT COUNT(*) FROM prodian_mro");
    $stmt->execute();
    $total_records = $stmt->fetchColumn();

    $total_pages = ceil($total_records / $limit);

    if ($total_pages > 1) {
    ?>
    <nav style="float: right; margin-top: 5px">
        <ul class="pagination">
            <li class="page-item <?php if ($page <= 1) {
                echo 'disabled';
            } ?>">
                <a class="page-link" href="prodian-mro.php?page1=<?php echo $page - 1; ?>"
                  aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($page == $i) {
                    echo 'active';
                } ?>" style="<?php if ($page == $i) {
                    echo 'color: black;';
                } ?>">
                    <a class="page-link" href="prodian-mro.php?page1=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page >= $total_pages) {
                echo 'disabled';
            } ?>">
                <a class="page-link" href="prodian-mro.php?page1=<?php echo $page + 1; ?>"
                  aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php } ?>
    </div>
    </div>

    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
          <div class="col-12">
            <div class="card asset-list  overflow-auto">

              <div class="card-body">
                <h5 class="card-title">Last Check-up Assets</h5>
                <table class="table table-borderless table-hover table-responsive">
                  <thead>
                    <tr class="align=middle text-center">
                      <th scope="col">Requestor</th>
                      <th scope="col">Department</th>
                      <th scope="col">Name of Assets</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php  
                    $limit = 5; // Number of records per page
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $start = ($page - 1) * $limit;

                    $stmt = $conn->prepare("SELECT * FROM mro_checkup ORDER BY id ASC LIMIT :start, :limit");
                    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
                    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                    $stmt->execute();
                    $count = $stmt->rowCount();

                    if($count == 0) {
                        echo "<tr align=middle text-secondary text-center>";
                        echo "<td colspan='7' style='text-align:center;'>No checking assets found</td>";
                        echo "</tr>";
                    } else {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                      $id=$row['id'];
                  ?>
                  <tr class="align=middle text-secondary text-center" ondblclick="showModal(<?php echo $id;?>)">
                    <td><?php echo $row['rname'];?></td>
                    <td><?php echo $row['dept'];?></td>
                    <td><?php echo $row['a_name'];?></td>
                    <td><span style="font-size: 1.em; padding: 0.75em 1.25em;" class="badge bg-info text-dark">Checking</span></td>
                  </tr>
              <?php } }?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">
        <div class="card asset-list">
          <div class="card-body">
            <h5 class="card-title">Last Recent Repair Assets</h5>
            <table class="table table-borderless table-hover table-responsive">
            <thead>
              <tr class="align=middle text-center">
                <th scope="col">Name of Assets</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                <?php  
              $limit = 5; // Number of records per page
              $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $start = ($page - 1) * $limit;

              $stmt = $conn->prepare("SELECT * FROM mro_reparation ORDER BY id ASC LIMIT :start, :limit");
              $stmt->bindParam(':start', $start, PDO::PARAM_INT);
              $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
              $stmt->execute();
              $count = $stmt->rowCount();

              if($count == 0) {
                  echo "<tr align=middle text-secondary text-center>";
                  echo "<td colspan='7' style='text-align:center;'>No repairing assets found</td>";
                  echo "</tr>";
              } else {
              while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $id=$row['id'];
            ?>
            <tr class="align=middle text-secondary text-center" ondblclick="showModal(<?php echo $id;?>)">
              <td><?php echo $row['a_name'];?></td>
              <td><span style="font-size: 1.em; padding: 0.75em 1.25em;" class="badge bg-danger text-light">Repairing</span></td>
              </tr>
            <?php } }?>
            </tbody>
          </table>
          </div>

        </div><!-- End Recent Activity -->
      </div>
    </div>

    <div class="card">
    <div class="card-body">  
      <h5 class="card-title">Last Repaired Assets</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Requestor</th>
            <th scope="col">Position</th>
            <th scope="col">Department</th>
            <th scope="col">Name of Assets</th>
            <th scope="col">Status</th>
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
          $limit = 5; // Number of records per page
          $page = isset($_GET['page2']) ? (int)$_GET['page2'] : 1;
          $start = ($page - 1) * $limit;
    
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM mro_repaired WHERE rname LIKE :search OR rpos LIKE :search ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
          } else {
            $stmt = $conn->prepare("SELECT * FROM mro_repaired ORDER BY id ASC LIMIT :start, :limit");
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
                  echo "<td colspan='7' style='text-align:center;'>No repaired assets found</td>";
              }
              echo "</tr>";
          } else {
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $id=$row['id'];
        ?>
        <tr class="align=middle text-secondary text-center" ondblclick="showModal(<?php echo $id;?>)">
          <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
          <td><?php echo $row['position'];?></td>
          <td><?php echo $row['dept'];?></td>
          <td><?php echo $row['a_name'];?></td>
          <td><span style="font-size: .70em; padding: 0.75em 1.25em;" class="badge bg-success text-light">Repaired</span></td>
          <td>
          <button class="btn btn-light border shadow-sm" style="width: 120px; height: 35px;" onclick="Confirmation(<?php echo $id;?>)">
          <a style="Color: #256D85"><i class="bi bi-truck" style='color: #256D85;'></i> Dispatch</a>
          </button>
          </td>

        <!-- Approve Swal -->
        <script>
          function Confirmation(id) {
            Swal.fire({
              title: 'Ready for Dispatch?',
              text: 'Do you want to dispatch this assets?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes!',
              cancelButtonText: 'Not yet'
            }).then((result) => {
              if (result.value) {
                window.location.href = '../../action/mro/approve/approve-req-mro.php?id=' + id;
              }
            })
          }
        </script>
    <?php } }?>
      </tbody>
    </table>
    </div>
    <?php
    // Retrieve the total number of rows that match the search criteria
    $stmt = $conn->prepare("SELECT COUNT(*) FROM mro_repaired");
    $stmt->execute();
    $total_records = $stmt->fetchColumn();

    $total_pages = ceil($total_records / $limit);

    if ($total_pages > 1) {
    ?>
    <nav style="float: right; margin-top: 5px">
        <ul class="pagination">
            <li class="page-item <?php if ($page <= 1) {
                echo 'disabled';
            } ?>">
                <a class="page-link" href="prodian-mro.php?page2=<?php echo $page - 1; ?>"
                  aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($page == $i) {
                    echo 'active';
                } ?>" style="<?php if ($page == $i) {
                    echo 'color: black;';
                } ?>">
                    <a class="page-link" href="prodian-mro.php?page2=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page >= $total_pages) {
                echo 'disabled';
            } ?>">
                <a class="page-link" href="prodian-mro.php?page2=<?php echo $page + 1; ?>"
                  aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php } ?>
    </div>
    </div>

    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/admin/footer.php'); ?>
  <!-- End Footer -->

</html>