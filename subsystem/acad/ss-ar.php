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
  var y = document.getElementById('ss')
  y.className = "nav-link ";
  var h = document.getElementById('ss-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Asset Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item active"><a href="#">Asset Requests</a></li>
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
                <h5 class="modal-title">Request Assets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form method="POST" action="action/add/ss-add-ar.php" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-12">
                  <span>Asset Name:</span>
                  <input type="text" name="assetname"class="form-control" placeholder="Asset Name" required>
                </div>
                <div class="col-md-12">
                  <span>QTY:</span>
                  <input type="number" min="1" name="qty" class="form-control" value="1">
                </div>
                <div class="col-md-12">
                <span>Date of Request:</span>
                  <input type="date" name="dateofreq"class="form-control" placeholder="Date of Registration">
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add" value="submit" class="btn btn-primary" id="addrequest">Request</button>              
                </div>
              </form>
              </div>
            </div>
          </div>
        <div class="card-body asset-list overflow-auto">
        <table class="table table-borderless table-hover table-responsive">
        <thead>
            <tr class="align=middle text-center">
              <th scope="col">Requestor</th>
              <th scope="col">Position</th>
              <th scope="col">Request</th>
              <th scope="col">Qty</th>
              <th scope="col">Date</th>
              <th scope="col">Status</th>
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
            
            $result=$conn->prepare("SELECT * FROM arm_ar ORDER BY id ASC LIMIT ?,? ");
            $result->bindValue(1, $offset, PDO::PARAM_INT);	
            $result->bindValue(2, $limit, PDO::PARAM_INT);	
            $result->execute();
            $cnt = 1;
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
            $id=$row['id'];
          ?>
          <tr class="align=middle text-secondary text-center">
            <td></td>
            <td></td>
            <td><?php echo $row['req_name'];?></td>
            <td><?php echo $row['req_qty'];?></td>
            <td><?php echo $row['req_date'];?></td>
            <td><span class="badge border-warning border-1 text-warning" style="font-size: 15px">Pending</span></td>
            <td>
              <button style='color: red;' class="btn btn-light border shadow-sm"><i class="bi bi-trash" style='color: red;'></i> Delete</button>
            </td>
          </tr>
      <?php } ?>
        </tbody>
      </table>
      </div>
      <?php	
        $result=$conn->prepare("SELECT * FROM arm_ar");
        $result->execute();
        
        $total_records=$result->fetchAll(PDO::FETCH_ASSOC);

        
        if($result->rowCount() > 0)
        {
          $total_page = ceil(count($total_records) / $limit);
          
          echo '<ul class="pagination" style="float: right; margin-top: 5px">';
          
          if($page > 1)
          {	
            echo '<li class="page-item"><a class="page-link" href="ss-ar.php?page='.($page - 1).'">
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
                <a class="page-link" href="ss-ar.php?page='.$i.'">'.$i.'</a> 
                </li>';
          }
          
          if($total_page > $page)
          {	
            echo '<li class="page-item"><a class="page-link" href="ss-ar.php?page='.($page + 1).'">
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
  <?php include ('partials/footer.php'); ?>
  <!-- End Footer -->

</html>