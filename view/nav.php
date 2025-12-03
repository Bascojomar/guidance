<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
              <?php
            if($_SESSION['role'] == 'counselor'){
            ?>
             <li class="sidebar-item">
               <a class="sidebar-link" href="appointment" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Request Appointment</span>
              </a>
              </li>
               

            <li class="sidebar-item">
               <a class="sidebar-link" href="conduct" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Conduct Sessions</span>
              </a>
              </li>
              <?php } ?>
              <?php
            if($_SESSION['role'] == 'student'){
            ?>
            <li class="sidebar-item">
               <a class="sidebar-link" href="studentApp" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Request Appointment</span>
              </a>
              </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="appoint" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Appointment</span>
              </a>
              </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="sessionNotes" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Session Notes</span>
              </a>
              </li>
             <?php } ?>
              <?php
            if($_SESSION['role'] == 'counselor'){
            ?>
            <li class="sidebar-item">
               <a class="sidebar-link" href="case" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Case File</span>
              </a>
              </li>
               
            <li class="sidebar-item">
               <a class="sidebar-link" href="report" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Report</span>
              </a>
              </li>
             
            <?php } ?>
               <?php
            if($_SESSION['role'] == 'admin'){
            ?>
            <li class="sidebar-item">
               <a class="sidebar-link" href="all_app" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">All Appointment</span>
              </a>
              </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="manage_user" aria-expanded="false">
                <i class="ti ti-aperture"></i>
                <span class="hide-menu">Manage Users</span>
              </a>
              </li>
            <?php } ?>

            </ul>
          
            </div>
          </div>
        </nav>