<?php
  include ('../../conn/connection.php');
?>
  <?php session_start();?>
  <?php include('../../partials/staff/head.php');?>

  <!-- ======= Header ======= -->
  <?php include('../../partials/staff/header.php');?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('../../partials/staff/sidebar.php');?>

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
  <h1>Request Asset</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="prodian-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Asset Management Request</a></li>
          <li class="breadcrumb-item active"><a href="prodian-staff-req.php">Request Asset</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div style="border-radius: 10px;" class="card">
                <div class="card-body" style="margin-left: 10px; margin-right: 10px; margin-bottom: 10px;">
                    <form class="row" method="post" style="margin-top: 15px;">
                        <div class="col-lg-6">
                            <div class="row">

                                <!-- Form -->
                                <div class="col-md-12 mb-1">
                                    <h5 class="card-title">Requestor Information</h5>
                                </div>
                                <!-- End Form -->
                            
                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Department Name</label>
                                    <!-- Select -->
                                    <div class="col-md-12">
                                        <select class="js-select form-select" name="dep_name" required>
                                            <option value="Choose...">Choose Department...</option>
                                            <option value="Learning Management System">Learning Management System</option>
                                            <option value="Faculty Management Information System">Faculty Management Information System</option>
                                            <option value="Academic Management System">Academic Management System</option>
                                            <option value="Enrollment">Enrollment</option>
                                            <option value="Registrar">Registrar</option>
                                            <option value="Human Resource">Human Resource</option>
                                            <option value="Payment Management System">Payment Management System</option>
                                            <option value="Property Custodian">Property Custodian</option>
                                            <option value="Student Portal">Student Portal</option>
                                            <option value="Crad">Crad</option>
                                            <option value="Prefect Of Discipline">Prefect Of Discipline</option>
                                            <option value="Safety And Security">Safety And Security</option>
                                            <option value="Clinic">Clinic</option>
                                            <option value="Guidance">Guidance</option>
                                            <option value="Quality Assurance">Quality Assurance</option>
                                            <option value="Logistic Management System">Logistic Management System</option>
                                            <option value="Management Information System">Management Information System</option>
                                            <option value="Event Management System">Event Management System</option>
                                        </select>
                                    </div>
                                    <!-- End Select -->
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="firstNameLabel" class="form-label">Full name</label>
                                    <div class="input-group input-group-sm-vertical">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" aria-label="Clarice" required>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" aria-label="Boone" required>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-7 mb-3">
                                    <label for="emailLabel" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" aria-label="clarice@site.com" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-5 mb-3">
                                    <label for="departmentLabel" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="e.g. 0000-000-0000" aria-label="Human resources" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" aria-label="Human resources" required>
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
                                    <label for="departmentLabel" class="form-label">Product Category</label>
                                    <input type="text" class="form-control" name="product_category" id="product_category" aria-label="Human resources" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Subcategory</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" aria-label="Human resources" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Type</label>
                                    <input type="text" class="form-control" name="product_type" id="dproduct_type" aria-label="Human resources" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-6 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Quantity</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" aria-label="Human resources" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Product Description</label>
                                    <input type="text" class="form-control" name="product_description" id="product_description" aria-label="Human resources" required>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="col-md-12 mb-3">
                                    <label for="departmentLabel" class="form-label">Date of Request</label>
                                    <input type="date" class="form-control" name="date" id="date" aria-label="Human resources" required>
                                    <input type="hidden" class="form-control" name="status" id="status" value="pending">
                                </div>
                                <!-- End Form -->

                            </div>
                        </div>

                        <!-- Footer -->
                        <div style="margin-top: 30px;" class="d-flex justify-content-end">
                            <button style="padding: 5px 30px; font-size: 18px;" type="submit" name="req_product" class="btn btn-primary">Submit</button>
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
  <?php include ('../../partials/staff/footer.php'); ?>
  <!-- End Footer -->

</html>