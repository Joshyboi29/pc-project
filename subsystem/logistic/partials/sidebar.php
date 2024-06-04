<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a id="dash" class="nav-link collapsed" href="subsystem.php">
      <i class="ri-layout-grid-line"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a id="ra" class="nav-link collapsed" href="log-ra.php">
      <i class="bi bi-folder-plus"></i>
      <span>Request Assets</span>
    </a>
  </li><!-- End Report Page Nav -->

  <li class="nav-item">
    <a id="ss" class="nav-link collapsed" data-bs-target="#ss-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-folder-received-line"></i><span>Vehicle Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="ss-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a id="vl" href="log-vl.php" class="inactive">
          <i class="bi bi-circle"></i><span>Vehicle List</span>
        </a>
      </li>
      <li>
        <a id="vr" href="log-vr.php" class="inactive">
          <i class="bi bi-circle"></i><span>Vehicle Request</span>
        </a>
      </li>
      <li>
        <a id="bv" href="log-bv.php" class="inactive">
          <i class="bi bi-circle"></i><span>Borrowed Vehicle</span>
        </a>
      </li>
    </ul><!-- End Asset Request Management Page Nav -->

</ul>

</aside><!-- End Sidebar-->