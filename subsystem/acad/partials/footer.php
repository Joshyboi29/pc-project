
  <footer id="footer" class="footer">
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

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