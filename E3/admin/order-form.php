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
  var x = document.getElementById('req')
  x.className = "active";
  var y = document.getElementById('arm')
  y.className = "nav-link ";
  var h = document.getElementById('arm-nav')
  h.className = "nav-content collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
  <h1>Order Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item"><a href="prodian-arm-req.php">Requested Assets</a></li>
          <li class="breadcrumb-item active"><a href="order-form.php">Order Form</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div style="border-radius: 10px;" class="card">
                <div class="card-body" style="margin-left: 10px; margin-right: 10px; margin-bottom: 10px;">
                    <form class="row" method="post" action="../../action/admin/request/req-ta-log.php" style="margin-top: 15px;">
                        <div class="col-lg-6">
                            <div class="row">

                                <!-- Form -->
                                <div class="col-md-12 mb-1">
                                <h5 class="card-title">Requestor Information</h5>
                                </div>
                                <!-- End Form -->
                        
                                <?php
                                    // Get the id parameter from the URL
                                    $id = $_GET['id'];

                                    // Prepare the SQL query with the id parameter
                                    $stmt = $conn->prepare("SELECT * FROM req_ta WHERE id = :id");
                                    $stmt->bindParam(':id', $id);
                                    $stmt->execute();
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="dept" class="form-label">Department :</label>
                                    <div class="input-group input-group-sm-vertical">
                                        <input type="text" class="form-control" name="dept" value="<?php echo $row['dept'];?>" disabled>
                                        <input type="hidden" name="dept" value="<?php echo $row['dept'];?>">
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="firstNameLabel" class="form-label">Full name :</label>
                                    <div class="input-group input-group-sm-vertical">
                                        <input type="text" class="form-control" name="fname" value="<?php echo $row['fname'];?>" disabled>
                                        <input type="hidden" name="fname" value="<?php echo $row['fname'];?>">
                                        <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'];?>" disabled>
                                        <input type="hidden" name="lname" value="<?php echo $row['lname'];?>">
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-7 mb-3">
                                    <label for="emailLabel" class="form-label">Email :</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" disabled>
                                    <input type="hidden" name="email" value="<?php echo $row['email'];?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-5 mb-3">
                                    <label for="positionLabel" class="form-label">Position :</label>
                                    <input type="text" class="form-control" name="position" value="<?php echo $row['position'];?>" disabled>
                                    <input type="hidden" name="position" value="<?php echo $row['position'];?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Department Branch :</label>
                                    <input type="text" class="form-control" value="<?php echo $row['branch'];?>" disabled>
                                    <input type="hidden" name="branch" value="<?php echo $row['branch'];?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Date of Request</label>
                                    <input type="date" class="form-control" value="<?php echo $row['date'];?>" disabled>
                                    <input type="hidden" name="date" value="<?php echo $row['date'];?>">
                                </div>
                                <!-- End Form -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">

                                <!-- Form -->
                                <div class="col-md-12 mb-1">
                                    <h5 class="card-title">Product Request Information</h5>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Name :</label>
                                    <input type="text" class="form-control" name="pname" id="product_category" value="<?php echo $row['a_name'];?>" disabled>
                                    <input type="hidden" name="pname" value="<?php echo $row['a_name'];?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Quantity :</label>
                                    <input type="number" class="form-control" name="pqty" id="quantity" value="<?php echo $row['a_qty'];?>" disabled>
                                    <input type="hidden" name="pqty" value="<?php echo $row['a_qty'];?>">
                                </div>
                                <!-- End Form -->

                                <?php 
                                    $user = $_SESSION['user'];
                                ?>   

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Request By :</label>
                                    <input type="text" class="form-control" name="cname" value="<?php echo $user['fname'];?> <?php echo $user['lname'];?>" disabled>
                                    <input type="hidden" name="cname" value="<?php echo $user['fname'];?> <?php echo $user['lname'];?>">
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Description : (Optional)</label>
                                    <textarea class="form-control" style="height: 224%" name="desc"><?php echo $row['a_desc'];?></textarea>
                                </div>
                                <!-- End Form -->
                            </div>
                        </div>

                        <!-- Footer -->
                        <div style="margin-top: 30px;" class="d-flex justify-content-end">
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
  <?php include ('../../partials/admin/footer.php'); ?>
  <!-- End Footer -->

</html>