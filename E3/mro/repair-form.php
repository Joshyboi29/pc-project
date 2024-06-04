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
      <h1>Reparation Form<h1>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div style="border-radius: 10px;" class="card">
                <div class="card-body" style="margin-left: 10px; margin-right: 10px; margin-bottom: 10px;">
                    <form class="row" method="post" action="../../action/mro/reparation/mro-add-reparation.php" style="margin-top: 15px;">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="col-lg-6">
                            <div class="row">

                                <!-- Form -->
                                <div class="col-md-12 mb-1">
                                    <h5 class="card-title">Assets Info</h5>
                                </div>
                                <!-- End Form -->
                                <?php
                                    // Get the id parameter from the URL
                                    $id = $_GET['id'];

                                    // Prepare the SQL query with the id parameter
                                    $stmt = $conn->prepare("SELECT * FROM mro_checkup_done WHERE id = :id");
                                    $stmt->bindParam(':id', $id);
                                    $stmt->execute();
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <?php if ($row && $row['a_image'] != ""): ?>
                                        <img src="../../assets/img/prodian/<?php echo $row['a_image']; ?>" width="350px" height="350px" style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
                                    <?php else: ?>
                                        <!-- code to display a placeholder image or message -->
                                    <?php endif; ?>
                                </div>
                                <!-- End Form -->

                                <div class="col-md-12 mb-1">
                                    <h4 style="text-align: center;"><?php echo $row['a_name']; ?></h4>
                                    <input type="hidden" name="aname" value="<?php echo $row['a_name']; ?>">
                                </div>
                        
                                <div class="col-md-12 mb-1">
                                    <h5 class="card-title">Requestor Info</h5>
                                </div>

                                <!-- Form -->
                                <div class="col-md-7 mb-3">
                                    <label for="emailLabel" class="form-label">Requestor</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['fname']; ?> <?php echo $row['lname']; ?>" disabled>
                                    <input type="hidden" name="fname" value="<?php echo $row['fname']; ?>">
                                    <input type="hidden" name="lname" value="<?php echo $row['lname']; ?>">
                                </div>
                                <!-- End Form -->                                

                                <!-- Form -->
                                <div class="col-md-5 mb-3">
                                    <label for="departmentLabel" class="form-label">Position</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['position']; ?>" disabled>
                                    <input type="hidden" name="position" value="<?php echo $row['position']; ?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Department</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['dept']; ?>" disabled>
                                    <input type="hidden" name="dept" value="<?php echo $row['dept']; ?>">
                                </div>
                                <!-- End Form -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">

                                <!-- Form -->
                                <div class="col-md-12 mb-1">
                                    <h5 class="card-title">Reparation info</h5>
                                </div>
                                <!-- End Form -->

                                <?php 
                                    include ('../../conn/connection.php');
                                    $user = $_SESSION['user'];
                                ?>   

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Checking By</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['fname'];?> <?php echo $user['lname'];?>" disabled>
                                    <input type="hidden" name="cname" value="<?php echo $user['fname'];?> <?php echo $user['lname'];?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Position</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['position'];?>" disabled>
                                    <input type="hidden" name="cpos" value="<?php echo $user['position'];?>">
                                </div>
                                <!-- End Form -->
                                
                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Asset Issue (Problem)</label>
                                    <textarea class="form-control" name="aissue" style="height: 515px;"></textarea>
                                </div>
                                <!-- End Form -->

                            </div>
                        </div>

                    <!-- Footer -->
                    <div class="d-flex justify-content-end mt-3">
                        <button style="padding: 5px 30px; font-size: 18px;" type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- End Footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('../../partials/mro/footer.php'); ?>
  <!-- End Footer -->

</html>