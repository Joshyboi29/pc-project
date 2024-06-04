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
  var x = document.getElementById('ta')
  x.className = "active";
  var y = document.getElementById('ss')
  y.className = "nav-link ";
  var h = document.getElementById('ss-nav')
  h.className = "nav-content collapse show";
  var h = document.getElementById('sm')
  h.className = "collapse show";
  </script>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Other Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="subsystem.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item "><a href="#">Asset Requests</a></li>
          <li class="breadcrumb-item active"><a href="ss-req-ta.php">Other Requests</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
    <div class="col-lg-12">
        <div style="border-radius: 10px;" class="card">
            <div class="card-body" style="margin-left: 10px; margin-right: 10px; margin-bottom: 10px;">
                <form class="row" method="post" action="action/add/ss-add-req-ta.php" style="margin-top: 15px;">
                    <div class="col-lg-6">
                        <div class="row">

                            <!-- Form -->
                            <div class="col-md-12 mb-1">
                                <h5 class="card-title">Requestor Information</h5>
                            </div>
                            <!-- End Form -->
                        
                            <!-- Form -->
                            <div class="col-md-12 mb-3">
                                <label for="department" class="form-label">Department Name</label>
                                <!-- Select -->
                                <div class="col-md-12">
                                    <select name="department" class="form-select" required>
                                        <option>Choose...</option>
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
                                <!-- End Select -->
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-12 mb-3">
                                <label for="NameLabel" class="form-label">Full name</label>
                                <div class="input-group input-group-sm-vertical">
                                    <input type="text" class="form-control" name="fname" placeholder="Requestor First name" required>
                                    <input type="text" class="form-control" name="lname" placeholder="Requestor Last name" required>
                                </div>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-7 mb-3">
                                <label for="emailLabel" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-5 mb-3">
                                <label for="positionLabel" class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" id="position" placeholder="Requestor Position" required>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-12 mb-3">
                                <label for="branch" class="form-label">Branch Name</label>
                                <select name="branch" class="form-select" required>
                                    <option>Choose...</option>
                                    <option value="MV BESTLINK">MV BESTLINK</option>
                                    <option value="MAIN BESTLINK">MAIN BESTLINK</option>
                                </select>
                            </div>
                            <!-- End Form -->

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">

                            <!-- Form -->
                            <div class="col-md-12 mb-1">
                                <h5 class="card-title">Asset Request Information</h5>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-6 mb-3">
                                <label for="assetLabel" class="form-label">Asset Name</label>
                                <input type="text" class="form-control" name="aname" required>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-6 mb-3">
                                <label for="categoryLabel" class="form-label">Asset Category</label>
                                <div class="form-group">
                                    <select name="category" class="form-select" required>
                                        <option>Choose...</option>
                                        <option value="Equipments">Equipments</option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Utencils">Utencils</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-6 mb-3">
                                <label for="departmentLabel" class="form-label">Asset Quantity</label>
                                <input type="number" min="1" name="qty" class="form-control" required>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="col-md-6 mb-3">
                                <label for="departmentLabel" class="form-label">Date of Request</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <!-- End Form -->
                            
                            <!-- Form -->
                            <div class="col-md-12 mb-3">
                                <label for="departmentLabel" class="form-label">Product Description (Optional)</label>
                                <textarea class="form-control" style="height: 133%" name="desc"></textarea>
                            </div>
                            <!-- End Form -->


                        </div>
                    </div>

                    <!-- Footer -->
                    <div style="margin-top: 70px;" class="d-flex justify-content-end">
                        <button style="padding: 5px 30px; font-size: 18px;" type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- End Footer -->
                </form>

                <!-- Request Swal -->
                <script>
                    <?php
                    if (isset($_SESSION['request']) && $_SESSION['request'] == 1) {
                    ?>
                    Swal.fire({
                        title: "Request!",
                        text: "The item has been request.",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    <?php
                        unset($_SESSION['request']);
                    }
                    ?>
                </script> 
                </div>
            </div>
        </div>
    </div>
    </section>
    </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include ('partials/footer.php'); ?>
  <!-- End Footer -->

</html>