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
  var x = document.getElementById('blg')
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
          <form class="search-form d-flex align-items-center" method="POST" action="#">
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
                <form method="POST" action="../../action/admin/add/prodian-add-ta-blg.php" enctype="multipart/form-data" class="row g-3">
                  <div class="col-md-12">
                    <span>Select image:</span>
                    <input type="file" name="image"class="form-control">
                  </div>
                  <div class="col-md-12">
                    <span>Building Name:</span>
                    <input type="text" name="building"class="form-control" placeholder="Building Name">
                  </div>
                  <div class="col-md-12">
                    <span>Address:</span>
                    <input type="text" name="address"class="form-control" placeholder="Address">
                  </div>
                  <div class="col-md-12">
                    <span>Date of Construction:</span>
                    <input type="date" name="dateofcons"class="form-control" placeholder="Date of Construction">
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
              <th scope="col">#</th>
              <th scope="col">Image</th>
              <th scope="col">Building Name</th>
              <th scope="col">Address</th>
              <th scope="col">Date of Construction</th>
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
              $stmt = $conn->prepare("SELECT * FROM inventory_ta_blg WHERE blg_name LIKE :search OR address LIKE :search ORDER BY id ASC LIMIT :start, :limit");
              $stmt->bindParam(':search', $search);
              $stmt->bindParam(':start', $start, PDO::PARAM_INT);
              $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
              $stmt->execute();
              $count = $stmt->rowCount();
            } else {
              $stmt = $conn->prepare("SELECT * FROM inventory_ta_blg ORDER BY id ASC LIMIT :start, :limit");
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
            <td><?php echo $row['id'];?></td>
            <td><img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" height="60px" width="60px"></td>
            <td><?php echo $row['blg_name'];?></td>
            <td><?php echo substr($row['address'], 0, 30);?>...</td>
            <td><?php echo $row['date_const'];?></td>
            <td>
              <button class="btn btn-light border shadow-sm">
                <a href="#update<?php echo $id;?>" data-bs-toggle="modal">
                <i class="bi bi-pencil-square fa-lg" style="color:#256D85"></i></a>
              </button>
              <button class="btn btn-light border shadow-sm">
                <a href="#deleteModal_<?php echo $id;?>" data-bs-toggle="modal" >
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
                      <img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" width="450px" height="450px" style="display: block; margin-left: auto; margin-right: auto;">
                      <?php else: ?>
                      <?php endif; ?>
                      <h5 class="card-title">Asset Details</h5>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Building Name:</div>
                        <div class="col-lg-9 col-md-8"><?php echo $row['blg_name'];?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Address:</div>
                        <div class="col-lg-9 col-md-8"><?php echo $row['address'];?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Date of Construction:</div>
                        <div class="col-lg-9 col-md-8"><?php echo $row['date_const'];?></div>
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
                  <form method="POST" action="../../action/admin/edit/prodian-edit-ta-blg.php<?php echo '?id='.$id; ?>" enctype="multipart/form-data" class="row g-12">
                  <?php if($row['a_image'] != ""): ?>
                      <img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" width="450px" height="450px" style="display: block; margin-left: auto; margin-right: auto;">
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
                        <label for="blgname" class="col-md-4 col-lg-3 col-form-label">Building Name:</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="blgname" type="text" class="form-control" id="blgname" value="<?php echo $row['blg_name'];?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address:</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control" id="address" value="<?php echo $row['address'];?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                        <label for="dateofconst" class="col-md-4 col-lg-3 col-form-label">Date of Construction:</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="dateofconst" type="date" class="form-control" id="dateofconst" value="<?php echo $row['date_const'];?>">
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update" value="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

             <!-- Delete Modal -->
             <div class="modal fade" id="deleteModal_<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel_<?php echo $id; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel_<?php echo $id; ?>">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this record?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="../../action/admin/delete/prodian-delete-ta-blg.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>           

          </tr>
      <?php } }?>
        </tbody>
      </table>
      </div>
      <?php
        // Retrieve the total number of rows that match the search criteria
        if(isset($_POST['search'])) {
          $search = "%" . $_POST['search'] . "%";
          $stmt = $conn->prepare("SELECT COUNT(*) FROM inventory_ta_blg WHERE blg_name LIKE :search OR address LIKE :search");
          $stmt->bindParam(':search', $search);
          $stmt->execute();
          $total_records = $stmt->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM inventory_ta_blg");
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
            <a class="page-link" href="prodian-inventory-ta-blg.php?page=<?php echo $page-1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
          <li class="page-item <?php if($page == $i) { echo 'active'; } ?>" style="<?php if($page == $i) { echo 'color: black;'; } ?>">
            <a class="page-link" href="prodian-inventory-ta-blg.php?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php } ?>
          <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
            <a class="page-link" href="prodian-inventory-ta-blg.php?page=<?php echo $page+1; ?>" aria-label="Next">
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