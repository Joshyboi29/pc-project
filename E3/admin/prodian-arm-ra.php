<?php
  include ('conn/connection.php');
?>
  <?php session_start();?>
  <?php include('partials/admin/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('partials/admin/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('partials/admin/sidebar.php');?>

  <script>
  var x = document.getElementById('ra')
  x.className = "active";
  var y = document.getElementById('arm')
  y.className = "nav-link ";
  var h = document.getElementById('arm-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->


  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Received Assets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item active"><a href="#">Received Assets</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
    <div class="card-body">
      <h5 class="card-title">Assets List</h5>
      <div class="card-body asset-list overflow-auto">
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Position</th>
            <th scope="col">Department</th>
            <th scope="col">Assets</th>
            <th scope="col">Qty</th>
            <th scope="col">Date</th>
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
          
          $result=$conn->prepare("SELECT * FROM arm_ra ORDER BY id ASC LIMIT ?,? ");
          $result->bindValue(1, $offset, PDO::PARAM_INT);	
          $result->bindValue(2, $limit, PDO::PARAM_INT);	
          $result->execute();
          
          while($row=$result->fetch(PDO::FETCH_ASSOC)){
          $id=$row['id'];
        ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td></td>
          <td></td>
          <td></td>
          <td><?php echo $row['req_name'];?></td>
          <td><?php echo $row['req_qty'];?></td>
          <td><?php echo $row['req_date'];?></td>
          <td>
          <a href="#update<?php echo $id;?>" data-bs-toggle="modal"><i class="ri-check-fill ri-2x" style="color: green"></i>
          </a>
          <a href="#delete<?php echo $row['id']; ?>" data-toggle="modal" onclick="return confirm('Are you sure to Dispatch that supplies?');"><i class="ri-close-line ri-2x" style="color: red"></i></a>
          </td>
        </tr>
    <?php } ?>
      </tbody>
    </table>
    </div>
    <?php	
      $result=$conn->prepare("SELECT * FROM arm_ra");
      $result->execute();
      
      $total_records=$result->fetchAll(PDO::FETCH_ASSOC);

      
      if($result->rowCount() > 0)
      {
        $total_page = ceil(count($total_records) / $limit);
        
        echo '<ul class="pagination" style="float: right; margin-top: 5px">';
        
        if($page > 1)
        {	
          echo '<li class="page-item"><a class="page-link" href="prodian-arm-ra.php?page='.($page - 1).'">
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
              <a class="page-link" href="prodian-arm-ra.php?page='.$i.'">'.$i.'</a> 
              </li>';
        }
        
        if($total_page > $page)
        {	
          echo '<li class="page-item"><a class="page-link" href="prodian-arm-ra.php?page='.($page + 1).'">
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
  <?php include ('partials/admin/footer.php'); ?>
  <!-- End Footer -->

</html>