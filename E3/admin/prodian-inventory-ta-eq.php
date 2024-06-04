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
  var x = document.getElementById('ta1')
  x.className = "active";
  var x = document.getElementById('eq')
  x.className = "active";
  var y = document.getElementById('inv')
  y.className = "nav-link ";
  var h = document.getElementById('inventory-nav')
  h.className = "nav-content collapse show";
  var h = document.getElementById('sm1')
  h.className = "collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Tangible Assets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Inventory</a></li>
          <li class="breadcrumb-item active"><a href="#">Tangible Assets</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section">

  <div class="card">
    <div class="card-body">
    <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addassets"><i class="ri-add-fill ri-2x"></i>
      </button>
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
      <h5 class="card-title">Assets List</h5>
      <div class="modal fade" id="addassets" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Assets</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="../../action/admin/add/prodian-add-ta.php" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-12">
                  <span>Select image:</span>
                  <input type="file" name="image"class="form-control">
                </div>
                <div class="col-md-12">
                  <span>Serial #:</span>
                  <input type="text" name="serialnum"class="form-control" placeholder="Serial #" required>
                </div>
                <div class="col-md-12">
                  <span>Brand:</span>
                  <input type="text" name="brand"class="form-control" placeholder="Brand" required>
                </div>
                <div class="col-md-12">
                  <span>Asset Name:</span>
                  <input type="text" name="assetname"class="form-control" placeholder="Asset Name" required>
                </div>
                <div class="col-md-12">
                  <span>Department:</span>
                  <select name="department" class="form-select">
                    <option selected>Choose...</option>
                    <option value="CCS Department">CCS Department</option>
                    <option value="CRIM Department">CRIM Department</option>
                    <option value="EDUC Department">EDUC Department</option>
                    <option value="BSBA Department">BSBA Department</option>
                  </select>
                  </div>
                  <div class="col-md-12">
                    <span>Date of Used:</span>
                    <input type="date" name="dateofused"class="form-control" placeholder="Date of Used">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="add" value="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Image</th>
            <th scope="col">Serial #</th>
            <th scope="col">Brand</th>
            <th scope="col">Asset Name</th>
            <th scope="col">Department</th>
            <th scope="col">Date Used</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
        <?php  
          $limit = 5; // Number of records per page
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $start = ($page - 1) * $limit;
    
          if(isset($_POST['search'])) {
            $search = "%" . $_POST['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM inventory_ta_eq WHERE serial_num LIKE :search OR a_name LIKE :search OR brand LIKE :search ORDER BY id ASC LIMIT :start, :limit");
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
          } else {
            $stmt = $conn->prepare("SELECT * FROM inventory_ta_eq ORDER BY id ASC LIMIT :start, :limit");
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
                  echo "<td colspan='7' style='text-align:center;'>No data found</td>";
              }
              echo "</tr>";
          } else {
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $id=$row['id'];
        ?>

        <tr class="align=middle text-secondary text-center" ondblclick="showModal(<?php echo $id;?>)">
          <td><img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" height="70px" width="70px"></td>
          <td><?php echo $row['serial_num'];?></td>
          <td><?php echo $row['brand'];?></td>
          <td><?php echo $row['a_name'];?></td>
          <td><?php echo $row['dept'];?></td>
          <td><?php echo $row['date_used'];?></td>
          <td>
          <button class="btn btn-light border shadow-sm">
            <a href="#update<?php echo $id;?>" data-bs-toggle="modal">
            <i class="bi bi-pencil-square fa-lg" style="color:#256D85"></i></a>
          </button>
          <button class="btn btn-light border shadow-sm" onclick="deleteConfirmation(<?php echo $id;?>)">
            <i class="bi bi-trash fa-lg" style="color:#256D85"></i>
          </button>
          </td>

          <script>
          function showModal(id) {
            $("#view" + id).modal("show");
          }
          </script>
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
                    <img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" width="450px" height="450px" style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
                    <?php else: ?>
                    <?php endif; ?>
                    <h5 class="card-title">Asset Details</h5>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Serial #:</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['serial_num'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Brand:</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['brand'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Asset Name:</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['a_name'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Department:</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['dept'];?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Date of Used:</div>
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

          <!-- Update Modal -->                    
          <div class="modal fade" id="update<?php  echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Update Asset</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="../../action/admin/edit/prodian-edit-ta-eq.php<?php echo '?id='.$id; ?>" enctype="multipart/form-data" class="row g-12">
                <?php if($row['a_image'] != ""): ?>
                   <img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" width="450px" height="450px" style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
                    <?php else: ?>
                    <?php endif; ?>
                    <h5 class="card-title">Asset Details</h5>

                    <div class="row mb-3">
                      <label for="image" class="col-md-4 col-lg-3 col-form-label">Image:</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="image"class="form-control">
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="serialnum" class="col-md-4 col-lg-3 col-form-label">Serial #:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="serialnum" type="text" class="form-control" id="serialnum" value="<?php echo $row['serial_num'];?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                      <label for="brand" class="col-md-4 col-lg-3 col-form-label">Brand:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="brand" type="text" class="form-control" id="brand" value="<?php echo $row['brand'];?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                      <label for="assetname" class="col-md-4 col-lg-3 col-form-label">Asset Name:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="assetname" type="text" class="form-control" id="assetname" value="<?php echo $row['a_name'];?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                      <label for="unit" class="col-md-4 col-lg-3 col-form-label">Department:</label>
                        <div class="col-md-8 col-lg-9">
                          <select name="department" class="form-select">
                            <option selected><?php echo $row['dept'];?></option>
                            <option value="Learning Management System">Learning Management System</option>
                            <option value="Faculty Management Information System">Faculty Management Information System</option>
                            <option value="Academic Management System">Academic Management System</option>
                            <option value="Enrollment">Enrollment</option>
                            <option value="Registrar">Registrar</option>
                            <option value="Human Resource">Human Resource</option>
                            <option value="Payment Management System">Payment Management System</option>
                            <option value="Student Portal">Student Portal</option>
                            <option value="Crad">Crad</option>
                            <option value="Prefect Of Discipline">Prefect Of Discipline</option>
                            <option value="Clinic">Clinic</option>
                            <option value="Guidance">Guidance</option>
                            <option value="Quality Assurance">Quality Assurance</option>
                            <option value="Management Information System">Management Information System</option>
                            <option value="Event Management System">Event Management System</option>
                          </select>
                        </div>
                      </div>

                      <div class="row mb-3">
                      <label for="dateofused" class="col-md-4 col-lg-3 col-form-label">Date of Used:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="dateofused" type="date" class="form-control" id="dateofused" value="<?php echo $row['date_used'];?>">
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" id="update" name="update" value="submit" class="btn btn-primary">Update</button>
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
                    window.location.href = '../../action/admin/delete/prodian-delete-ta-eq.php?id=' + id;
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
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM inventory_ta_eq WHERE serial_num LIKE :search OR a_name LIKE :search OR brand LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM inventory_ta_eq");
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
            <a class="page-link" href="prodian-inventory-ta-eq.php?page=<?php echo $page-1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
          <li class="page-item <?php if($page == $i) { echo 'active'; } ?>" style="<?php if($page == $i) { echo 'color: black;'; } ?>">
            <a class="page-link" href="prodian-inventory-ta-eq.php?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php } ?>
          <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
            <a class="page-link" href="prodian-inventory-ta-eq.php?page=<?php echo $page+1; ?>" aria-label="Next">
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