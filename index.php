<?php
	include("conn/connection.php");
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Property Custodian</title>
	<link rel="shortcut icon" type="image" href="assets/img/iconlogo.png">
	<link rel="stylesheet" type="text/css" href="assets/css/E3/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!-- ======= Page Loader ======= -->
<?php include('partials/page-loader.php');?>
<!-- End Page Loader -->
<body>
	<img class="wave" src="assets/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="assets/img/undraw_delivery_truck_vt6p.svg">
		</div>
		<div class="login-content">
      <?php
      if (isset($_SESSION['error']) && $_SESSION['error'] == 1) {
          echo '
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
              Swal.fire({
                  title: "Error!",
                  text: "Invalid username or password!",
                  icon: "error",
                  confirmButtonText: "OK"
              });
          </script>
          ';
          unset($_SESSION['error']);
      }
      ?>
      <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] == 1) {
          echo '
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
            Swal.fire({
              title: "Login Success!",
              text: "Welcome '.$_SESSION["username"].'!",
              icon: "success",
              confirmButtonText: "OK"
            }).then(function() {
              window.location.href = "'.$_SESSION["redirect"].'";
            });
          </script>
          ';
          unset($_SESSION['success']); 
          unset($_SESSION['redirect']);
          unset($_SESSION["username"]);
        }
      ?>
			<form id="login-form" action="action/prodian-login-authentication.php" method="POST">
				<img src="assets/img/iconlogo.png">
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5> 
                    <input type="text" name="username" class="input" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
                     <input type="password" name="password" class="input" required>
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
              <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/login.js"></script>
</body>

<script>
// Select the preloader element
const preloader = document.querySelector('#preloader');

// Show the preloader when the page starts loading
window.addEventListener('load', () => {
  preloader.classList.remove('show-preloader');
});

// Hide the preloader when the page has finished loading
window.addEventListener('beforeunload', () => {
  preloader.classList.add('show-preloader');
});
</script>
</html>