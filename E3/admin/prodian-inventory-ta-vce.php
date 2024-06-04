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
  var x = document.getElementById('vce')
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
              <form method="POST" action="action/add/prodian-add-ta-vce.php" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-12">
                  <span>Select image:</span>
                  <input type="file" name="image"class="form-control">
                </div>
                <div class="col-md-12">
                  <span>Plate #:</span>
                  <input type="text" name="platenum"class="form-control" placeholder="Plate #" required>
                </div>
                <div class="col-md-12">
                  <span>OR #:</span>
                  <input type="text" name="ornum"class="form-control" placeholder="OR #" required>
                </div>
                <div class="col-md-12">
                  <span>CR #:</span>
                  <input type="text" name="crnum"class="form-control" placeholder="CR #" required>
                </div>
                <div class="col-md-12">
                  <span>Brand:</span>
                  <input type="text" name="brand"class="form-control" placeholder="Brand" required>
                </div>
                <div class="col-md-12">
                  <span>Vehicle Type:</span>
                  <select name="type" class="form-select">
                    <option selected>Choose...</option>
                    <option value="Motorcycle">Motorcycle</option>
                    <option value="Car">Car</option>
                    <option value="Van">Van</option>
                    <option value="Bus">Bus</option>
                    <option value="Truck">Truck</option>  
                  </select>
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
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Plate</th>
            <th scope="col">OR</th>
            <th scope="col">CR</th>
            <th scope="col">Brand</th>
            <th scope="col">Vehicle Type</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
        <?php  
          if(isset($_GET['page']))
          {
            $page=$_GET['page'];
          }
          else
          {
            $page = 1;
          }
          
          $limit = 5;
          
          $offset=($page-1)*$limit;
          
          $result=$conn->prepare("SELECT * FROM inventory_ta_vce ORDER BY id ASC LIMIT ?,? ");
          $result->bindValue(1, $offset, PDO::PARAM_INT);	
          $result->bindValue(2, $limit, PDO::PARAM_INT);	
          $result->execute();
          
          while($row=$result->fetch(PDO::FETCH_ASSOC)){
          $id=$row['id'];
        ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" height="70px" width="70px"></td>
          <td><?php echo $row['plate_num'];?></td>
          <td><?php echo $row['or_num'];?></td>
          <td><?php echo $row['cr_num'];?></td>
          <td><?php echo $row['b_name'];?></td>
          <td><?php echo $row['vce_type'];?></td>
          <td>
          <a href="#update<?php echo $id;?>" data-bs-toggle="modal"><i class="ri-edit-fill ri-xl" style="color:#256D85"></i>
          </a>
          <a href="#delete<?php echo $row['id']; ?>" data-toggle="modal" onclick="return confirm('Are you sure to Dispatch that supplies?');"><i class="ri-truck-line ri-xl" style="color:#256D85"></i></a>
          </td>
          <!-- Update Modal -->                    
          <div class="modal fade" id="update<?php  echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">>
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Update Asset</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="action/edit/prodian-edit-ta-vce.php<?php echo '?id='.$id; ?>" enctype="multipart/form-data" class="row g-12">
                  <div class="col-md-12">
                    <?php if($row['a_image'] != ""): ?>
                    <img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" width="200px" height="200px" style="display: block; margin-left: auto; margin-right: auto;">
                    <?php else: ?>
                    <?php endif; ?>
                    <input type="file" name="image"class="form-control">
                  </div>
                  <div class="col-md-12">
                    <span>Plate #:</span>
                    <input type="text" name="platenum"class="form-control" value="<?php echo $row['plate_num'];?>" required>
                  </div>
                  <div class="col-md-12">
                    <span>OR #:</span>
                    <input type="text" name="ornum"class="form-control" value="<?php echo $row['or_num'];?>" required>
                  </div>
                  <div class="col-md-12">
                    <span>CR #:</span>
                    <input type="text" name="crnum"class="form-control" value="<?php echo $row['cr_num'];?>" required>
                  </div>
                  <div class="col-md-12">
                    <span>Brand:</span>
                    <input type="text" name="brand"class="form-control" value="<?php echo $row['b_name'];?>" required>
                  </div>
                  <div class="col-md-12">
                    <span>Vehicle Type:</span>
                    <select name="type" class="form-select">
                      <option selected><?php echo $row['vce_type'];?></option>
                      <option value="Motorcycle">Motorcycle</option>
                      <option value="Car">Car</option>
                      <option value="Van">Van</option>
                      <option value="Bus">Bus</option>
                      <option value="Truck">Truck</option>  
                    </select>
                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="update" value="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </tr>
    <?php } ?>
      </tbody>
    </table>
    </div>
    <?php	
      $result=$conn->prepare("SELECT * FROM inventory_ta_vce");
      $result->execute();
      
      $total_records=$result->fetchAll(PDO::FETCH_ASSOC);

      
      if($result->rowCount() > 0)
      {
        $total_page = ceil(count($total_records) / $limit);
        
        echo '<ul class="pagination" style="float: right; margin-top: 5px">';
        
        if($page > 1)
        {	
          echo '<li class="page-item"><a class="page-link" href="prodian-inventory-ta-vce.php?page='.($page - 1).'">
                <span aria-hidden="true">&laquo;</span></a></li>';	
        }
        
        for($i=1; $i<=$total_page; $i++)
        {
          if($i == $page){
            
            $active = "active";	
          }
          else{
            
            $active = "";
          }
              
          echo '<li class="page-item '.$active.' ">
              <a class="page-link" href="prodian-inventory-ta-vce.php?page='.$i.'">'.$i.'</a> 
              </li>';
        }
        
        if($total_page > $page)
        {	
          echo '<li class="page-item"><a class="page-link" href="prodian-inventory-ta-vce.php?page='.($page + 1).'">
                <span aria-hidden="true">&raquo;</span></a></li>';		
        }
          
        echo '</ul>';	
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