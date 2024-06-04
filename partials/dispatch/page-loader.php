<div id="preloader" class="preloader">
  <div class="loader"></div>
</div>

<style>
.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #f6f9ff;
  z-index: 99999;
  display: none;
}

.show-preloader {
  display: block;
}

.loader {
  border: 10px solid #f6f9ff;
  border-top: 10px solid #3498db;
  border-radius: 50%;
  width: 75px;
  height: 75px;
  animation: spin 1s linear infinite;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -30px;
  margin-left: -30px;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>