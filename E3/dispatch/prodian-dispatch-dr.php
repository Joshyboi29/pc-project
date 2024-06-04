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
  var x = document.getElementById('dr')
  x.className = "nav-link ";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Drivers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="prodian-dispatch-dr.php">Drivers</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">
      <button class="btn" style="color: #fff; width: 170px; height: 40px; float: right; margin-top: 10px; border: none;" data-bs-toggle="modal" data-bs-target="#adddriver">
        <a style="Color: #47B5FF"><i class="bx bx-car"></i> <b>Add driver</b></a>
      </button>
      <h5 class="card-title">All Drivers</h5>
      <div class="modal fade" id="adddriver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Driver</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="../../action/dispatch/add/dispatch-add-dr.php" enctype="multipart/form-data">
              <div class="row mb-3">
                <label for="lid" class="col-md-4 col-lg-3 col-form-label"><b>Licences ID</b></label>
                <div class="col-md-8 col-lg-9">
                  <input name="lid" type="text" class="form-control" placeholder="N03-12-123456" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="fullname" class="col-md-4 col-lg-3 col-form-label"><b>Full Name</b></label>
                <div class="col-md-8 col-lg-9">
                  <div class="form-group d-flex">
                    <input type="fname" class="form-control mr-2" name="fname" placeholder="First name" required>
                    <input type="lname" class="form-control" name="lname" placeholder="Last name" required>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="age" class="col-md-4 col-lg-3 col-form-label"><b>Age</b></label>
                <div class="col-md-8 col-lg-9">
                  <input name="age" type="text" class="form-control" placeholder="Age of driver" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-lg-3 col-form-label"><b>Email</b></label>
                <div class="col-md-8 col-lg-9">
                  <input name="email" type="email" class="form-control" placeholder="example@netcom.com" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="cp" class="col-md-4 col-lg-3 col-form-label"><b>Cellphone #</b></label>
                <div class="col-md-8 col-lg-9">
                  <input name="cp" type="tel" pattern="[0-9]{11}" class="form-control" placeholder="09*********" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" name="add" class="btn btn-success">Add Driver</button>
            </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Licences ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Age</th>
            <th scope="col">Email</th>
            <th scope="col">Phone #</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
      <script>
        <?php
          if (isset($_SESSION['add']) && $_SESSION['add'] == 1) {
        ?>
          Swal.fire({
            title: "Driver Added!",
            text: "The Driver info has been added.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['add']);
          }
        ?>
      </script> 
      <?php  
        $limit = 12; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $stmt = $conn->prepare("SELECT * FROM dispatch_dr ORDER BY id ASC LIMIT :start, :limit");
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0) {
            echo "<tr align=middle text-secondary text-center>";
                echo "<td colspan='7' style='text-align:center;'>No Available Vehicle</td>";
            echo "</tr>";
        } else {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $id=$row['id'];
      ?>
      
      <tr class="align=middle text-secondary text-center">
        <td><?php echo $row['l_id'];?></td>
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
        <td><?php echo $row['age'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['cp'];?></td>
        <td>
        <button class="btn btn-light border shadow-sm">
          <a href="#update<?php echo $id;?>" data-bs-toggle="modal">
          <i class="bi bi-pencil-square fa-lg" style="color:#256D85"></i></a>
        </button>
        <button class="btn btn-light border shadow-sm" onclick="deleteConfirmation(<?php echo $id;?>)">
          <i class="bi bi-trash fa-lg" style="color:#256D85"></i>
        </button>
        </td>

        <!-- Update Modal -->                    
        <div class="modal fade" id="update<?php  echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Update Driver's Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form method="POST" action="../../action/dispatch/edit/prodian-edit-dr.php<?php echo '?id='.$id; ?>" enctype="multipart/form-data" class="row g-12">

                <div class="row mb-3">
                <label for="lid" class="col-md-4 col-lg-3 col-form-label">Licence ID :</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="lid" type="text" class="form-control" value="<?php echo $row['l_id'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                <label for="fullname" class="col-md-4 col-lg-3 col-form-label">Driver Name :</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-group d-flex">
                      <input type="fname" class="form-control mr-2" name="fname" value="<?php echo $row['fname'];?>">
                      <input type="lname" class="form-control" name="lname" value="<?php echo $row['lname'];?>">
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                <label for="age" class="col-md-4 col-lg-3 col-form-label">Driver Age :</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="age" type="text" class="form-control" value="<?php echo $row['age'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                <label for="email" class="col-md-4 col-lg-3 col-form-label">Driver email :</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control"value="<?php echo $row['email'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                <label for="assetname" class="col-md-4 col-lg-3 col-form-label">Cellphone # :</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="cp" type="tel" pattern="[0-9]{11}" class="form-control" value="<?php echo $row['cp'];?>">
                  </div>
                </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="update" name="update" value="submit" class="btn btn-success">Update</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        
        <!-- Update Swal -->
        <?php
          if (isset($_SESSION['update']) && $_SESSION['update'] == 1) {
            echo '
            <script>
              Swal.fire({
                title: "Updated!",
                text: "Successfully Update",
                icon: "success",
                confirmButtonText: "OK"
              });
            </script>
            ';
            unset($_SESSION['update']);
          }
        ?>
        <!-- Error Swal -->
        <?php
          if (isset($_SESSION['error']) && $_SESSION['error'] == 1) {
            echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Data update failed, please try again.",
                confirmButtonText: "OK"
              });
            </script>
            ';
            unset($_SESSION['error']);
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
                window.location.href = '../../action/dispatch/delete/prodian-delete-dr.php?id=' + id;
              }
            })
          }
        </script>
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

      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <?php
      // Retrieve the total number of rows that match the search criteria
      $stmt = $conn->prepare("SELECT COUNT(*) FROM dispatch_dr");
      $stmt->execute();
      $total_records = $stmt->fetchColumn();
        
      $total_pages = ceil($total_records / $limit);

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
    ?>
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/dispatch/footer.php'); ?>
  <!-- End Footer -->

</html>