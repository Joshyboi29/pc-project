<?php
  include ('../../conn/connection.php');
?>
  <?php session_start();?>
  <?php include('../../partials/mro/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('../../partials/mro/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('../../partials/mro/sidebar.php');?>

  <script>
  var x = document.getElementById('repair')
  x.className = "active";
  var y = document.getElementById('rr')
  y.className = "nav-link ";
  var h = document.getElementById('rr-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Reparation<h1>
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
            <th scope="col">Name of Assets</th>
            <th scope="col">Status</th>
            <th scope="col">Checking by</th>
            <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
      <!-- Approve Swal -->
      <script>
        <?php
          if (isset($_SESSION['accept']) && $_SESSION['accept'] == 1) {
        ?>
          Swal.fire({
            title: "Done!",
            text: "The asset has repaired and ready for dispatch.",
            icon: "success",
            confirmButtonText: "OK"
          });
        <?php
            unset($_SESSION['accept']);
          }
        ?>
      </script> 
      <?php  
      $limit = 12; // Default number of records per page
      $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : $limit;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $start = ($page - 1) * $limit;

      $stmt = $conn->prepare("SELECT * FROM mro_reparation ORDER BY id ASC LIMIT :start, :limit");
      $stmt->bindParam(':start', $start, PDO::PARAM_INT);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0) {
        echo "<tr align=middle text-secondary text-center>";
        echo "<td colspan='7' style='text-align:center;'>No Available Request</td>";
        echo "</tr>";
      } else {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
      $id=$row['id'];
      ?>
      
      <tr class="align=middle text-secondary text-center">
        <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
        <td><?php echo $row['a_name'];?></td>
        <td><span style="font-size: 1.em; padding: 0.75em 1.25em;" class="badge bg-danger text-light">Repairing</span></td>
        <td><?php echo $row['cname'];?></td>
        <td>
        <button class="btn btn-light border shadow-sm" style="width: 120px; height: 35px;" onclick="approveConfirmation(<?php echo $id;?>)">
          <a style="Color: Green"><i class="bi bi-tools" style='color: green;'></i> Repaired</a>
        </button>
        </td>

        <!-- Approve Swal -->
        <script>
          function approveConfirmation(id) {
            Swal.fire({
              title: 'Confirm Check-up?',
              text: 'Do you want to check-up this asset?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, accept it!',
              cancelButtonText: 'Not yet'
            }).then((result) => {
              if (result.value) {
                window.location.href = '../../action/mro/reparation/mro-repaired.php?id=' + id;
              }
            })
          }
        </script>
      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <div style="float: left;">
    <label for="limit">Show:</label>
    <select name="limit" id="limit" onchange="location = this.value;">
      <option value="?limit=5&page=1" <?php if($limit == 5) { echo 'selected'; } ?>>5</option>
      <option value="?limit=7&page=1" <?php if($limit == 7) { echo 'selected'; } ?>>7</option>
      <option value="?limit=12&page=1" <?php if($limit == 12) { echo 'selected'; } ?>>12</option>
      <option value="?limit=25&page=1" <?php if($limit == 25) { echo 'selected'; } ?>>25</option>
    </select>
    <label class="text-secondary"> entries</label>
    </div>    
    <?php
    // Retrieve the total number of rows that match the search criteria
    $stmt = $conn->prepare("SELECT COUNT(*) FROM mro_reparation");
    $stmt->execute();
    $total_records = $stmt->fetchColumn();

    $total_pages = ceil($total_records / $limit);
    
    // Only display the pagination if there is more than one page
    if ($total_pages > 1) {
    ?>
    <nav style="float: right; margin-top: 5px">
      <ul class="pagination">
        <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-mro-repair.php?page=<?php echo $page-1; ?>&limit=<?php echo $limit; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
        <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
          <a class="page-link" href="prodian-mro-repair.php?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>">
            <?php echo $i; ?>
          </a>
        </li>
        <?php } ?>
        <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-mro-repair.php?page=<?php echo $page+1; ?>&limit=<?php echo $limit; ?>" aria-label="Next">
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
  <?php include ('../../partials/mro/footer.php'); ?>
  <!-- End Footer -->

</html>