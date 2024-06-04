<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a id="dash" class="nav-link collapsed" href="prodian-dashboard.php">
      <i class="ri-layout-grid-line"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a id="arm" class="nav-link collapsed" data-bs-target="#arm-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-folder-received-line"></i><span>Asset Management Request</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="arm-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a id="ar" data-bs-target="#sm" data-bs-toggle="collapse" href="#">
          <i class="bi bi-circle"></i><span>Procurement Request</span>
        </a>
        <ul id="sm" class="sub-menu collapse">
          <li>
            <a id="ssa" href="prodian-arm-req-ssa.php" class="inactive">Supplies Request</a>
          </li>
          <li>
            <a id="ta" href="prodian-arm-req-ta.php" class="inactive">Other Request</a>
          </li>
        </ul>
      </li>
      <li>
        <a id="req" href="prodian-arm-req.php" class="inactive">
          <i class="bi bi-circle"></i><span>Request Assets</span>
        </a>
      </li>
      <li>
        <a id="rec" href="prodian-arm-rec.php" class="inactive">
          <i class="bi bi-circle"></i><span>Receiving Assets</span>
        </a>
      </li>
    </ul>
  </li><!-- End Asset Request Management Page Nav -->
    
    <li class="nav-item">
    <a id="inv" class="nav-link collapsed" data-bs-target="#inventory-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-table-alt-line"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="inventory-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a id="ssa1" href="prodian-inventory-ssa.php" class="inactive">
          <i class="bi bi-circle"></i><span>Supplies Assets</span>
        </a>
      </li>
      <li>
        <a id="ta1" data-bs-target="#sm1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-circle"></i><span>Tangible Assets</span>
        </a>
        <ul id="sm1" class="sub-menu collapse">
          <li>
            <a id="eq" href="prodian-inventory-ta-eq.php" class="inactive">Equipments</a>
          </li>
          <li>
            <a id="fnt" href="prodian-inventory-ta-fnt.php" class="inactive">Furniture</a>
          </li>
          <li>
            <a id="blg" href="prodian-inventory-ta-blg.php" class="inactive">Building</a>
          </li>
          <li>
            <a id="vce" href="prodian-inventory-ta-vce.php" class="inactive">Vehicle</a>
          </li>
          <li>
            <a id="ld" href="prodian-inventory-ta-oth.php" class="inactive">Other</a>
          </li>
        </ul>
      </li>
      <li>
        <a id="poa" href="prodian-inventory-poa.php" class="inactive">
          <i class="bi bi-circle"></i><span>Pull Out Assets</span>
        </a>
      </li>
    </ul><!-- End Inventory Page Nav -->

  <li class="nav-item">
    <a id="mro" class="nav-link collapsed" href="prodian-mro.php">
      <i class="ri-tools-fill"></i>
      <span>Maintenance, Repair, Operations</span>
    </a>
  </li><!-- End M.R.O Page Nav -->

  <li class="nav-item">
    <a id="dispose" class="nav-link collapsed" href="prodian-disposal.php">
      <i class="bi bi-trash-fill"></i>
      <span>Disposal</span>
    </a>
  </li><!-- End Disposal Page Nav -->

  <li class="nav-item">
    <a id="dispatch" class="nav-link collapsed" href="prodian-dispatch.php">
      <i class="ri-truck-fill"></i>
      <span>Dispatch</span>
    </a>
  </li><!-- End Blank Page Nav -->

  <li class="nav-heading">Other Pages</li>

  <li class="nav-item">
    <a id="report" class="nav-link collapsed" href="#">
      <i class="ri-file-copy-2-line"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Report Page Nav -->

  <li class="nav-item">
    <a id="report" class="nav-link collapsed" href="#">
      <i class="ri-file-copy-2-line"></i>
      <span>User</span>
    </a>
  </li><!-- End Report Page Nav -->

</ul>

</aside><!-- End Sidebar-->