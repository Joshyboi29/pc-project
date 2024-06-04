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
    <a id="ss" class="nav-link collapsed" data-bs-target="#ss-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-folder-received-line"></i><span>Asset Management Request</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="ss-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a id="ar" data-bs-target="#sm" data-bs-toggle="collapse" href="#">
          <i class="bi bi-circle"></i><span>Request Assets</span>
        </a>
        <ul id="sm" class="sub-menu collapse">
          <li>
            <a id="ssa" href="ss-req-ssa.php" class="inactive">Supplies Request</a>
          </li>
          <li>
            <a id="ta" href="ss-req-ta.php" class="inactive">Other Request</a>
          </li>
          <li>
            <a id="rl" href="ss-rl.php" class="inactive">Request List</a>
          </li>
        </ul>
      </li>
      <li>
        <a id="ra" href="ss-req-ra.php" class="inactive">
          <i class="bi bi-circle"></i><span>Receiving Request</span>
        </a>
      </li>
      <li>
        <a id="us" data-bs-target="#sm1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-circle"></i><span>Used Assets</span>
        </a>
        <ul id="sm1" class="sub-menu collapse">
          <li>
            <a id="eq" href="ss-us-eq.php" class="inactive">Equipments</a>
          </li>
          <li>
            <a id="fnt" href="ss-us-fnt.php" class="inactive">Furnitures</a>
          </li>
          <li>
            <a id="oth" href="ss-us-oth.php" class="inactive">Others</a>
          </li>
        </ul>
      </li>
    </ul><!-- End Asset Request Management Page Nav -->

</ul>

</aside><!-- End Sidebar-->