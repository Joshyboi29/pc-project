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
  var x = document.getElementById('check')
  x.className = "active";
  var y = document.getElementById('rr')
  y.className = "nav-link ";
  var h = document.getElementById('rr-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Checking<h1>
  </div><!-- End Page Title -->
    <section class="section">
    <div class="card">
    <div class="card-body">
      <h5 class="card-title">Pending Check-up</h5>
      <div class="card-body asset-list overflow-auto">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="prodian-mro-checkup-pen.php" role="tab" aria-selected="true" >Pending</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="prodian-mro-checkup-done.php" role="tab" aria-selected="false" style="color: #256D85;">Done</a>
        </li>
      </ul>
      <table class="table table-borderless table-hover table-responsive">
      <thead>
          <tr class="align=middle text-center">
            <th scope="col">Requestor</th>
            <th scope="col">Name of Assets</th>
            <th scope="col">Status</th>
            <th scope="col">Operation</th>
          </tr>
      </thead>
      <tbody>
      <?php  
        $limit = 5; // Default number of records per page
        $limit = isset($_GET['limit1']) ? (int)$_GET['limit1'] : $limit;
        $page = isset($_GET['page1']) ? (int)$_GET['page1'] : 1;
        $start = ($page - 1) * $limit;

        $stmt = $conn->prepare("SELECT * FROM mro_checkup ORDER BY id ASC LIMIT :start, :limit");
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0) {
            echo "<tr align=middle text-secondary text-center>";
            echo "<td colspan='7' style='text-align:center;'>No pending check-up</td>";
            echo "</tr>";
        } else {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $id=$row['id'];
      ?>
      
      <tr class="align=middle text-secondary text-center">
        <td><?php echo $row['fname'];?> <?php echo $row['fname'];?></td>
        <td><?php echo $row['a_name'];?></td>
        <td><span style="font-size: 1.em; padding: 0.75em 1.25em;" class="badge bg-info text-dark">Checking</span></td>
        <td>
        <button class="btn btn-light border shadow-sm" style="width: 120px; height: 35px;" onclick="approveConfirmation(<?php echo $id;?>)">
          <a href='../../action/mro/checking/mro-checking-done.php?id=<?php echo $id;?>' style='Color: Green'><i class='bi bi-clipboard-check' style='color: green;'></i> Done</a>
        </button>
        </td>
      </tr>
  <?php }} ?>
      </tbody>
    </table>
    </div>
    <div style="float: left;">
        <label for="limit1">Show:</label>
        <select name="limit1" id="limit1" onchange="location = this.value;">
            <option value="?limit1=5&page1=1" <?php if($limit == 5) { echo 'selected'; } ?>>5</option>
            <option value="?limit1=7&page1=1" <?php if($limit == 7) { echo 'selected'; } ?>>7</option>
            <option value="?limit1=12&page1=1" <?php if($limit == 12) { echo 'selected'; } ?>>12</option>
            <option value="?limit1=25&page1=1" <?php if($limit == 25) { echo 'selected'; } ?>>25</option>
        </select>
        <label class="text-secondary"> entries</label>
    </div>
    <?php
      // Retrieve the total number of rows that match the search criteria
      $stmt = $conn->prepare("SELECT COUNT(*) FROM mro_checkup_done");
      $stmt->execute();
      $total_records = $stmt->fetchColumn();

      $total_pages = ceil($total_records / $limit);
      
      // Only display the pagination if there is more than one page
      if ($total_pages > 1) {
    ?>
      <nav style="float: right; margin-top: 5px">
      <ul class="pagination">
        <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-mro-checkup.php?page1=<?php echo $page-1; ?>&limit1=<?php echo $limit; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
          <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
            <a class="page-link" href="prodian-mro-checkup.php?page1=<?php echo $i; ?>&limit1=<?php echo $limit; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php } ?>
        <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
          <a class="page-link" href="prodian-mro-checkup.php?page1=<?php echo $page+1; ?>&limit1=<?php echo $limit; ?>" aria-label="Next">
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