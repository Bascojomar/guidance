<?php 
  include "backend/database.php";
  include "backend/session.php";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free Bootstrap Admin Template by Adminmart</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  App Topstrip -->
    <div class="app-topstrip bg-dark py-3 px-4 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-none d-sm-flex align-items-center justify-content-center gap-9 mb-3 mb-lg-0">
        <a class="d-flex justify-content-center" href="https://www.wrappixel.com/" target="_blank">
          <img src="../assets/images/logos/logo-adminmart.svg" alt="" width="150">
        </a>

        <div class="d-none d-xl-flex align-items-center gap-3 border-start border-white border-opacity-25 ps-9">
          <a target="_blank" href="https://adminmart.com/templates/bootstrap/"
            class="link-hover d-flex align-items-center gap-2 border-0 text-white lh-sm fs-4">
            <iconify-icon class="fs-6" icon="solar:window-frame-linear"></iconify-icon>
            Templates
          </a>
          <a target="_blank" href="https://adminmart.com/support/"
            class="link-hover d-flex align-items-center gap-2 border-0 text-white lh-sm fs-4">
            <iconify-icon class="fs-6" icon="solar:question-circle-linear"></iconify-icon>
            Help
          </a>
          <a target="_blank" href="https://adminmart.com/hire-us/"
            class="link-hover d-flex align-items-center gap-2 border-0 text-white lh-sm fs-4">
            <iconify-icon class="fs-6" icon="solar:case-round-linear"></iconify-icon>
            Hire Us
          </a>
        </div>
      </div>

   

    </div>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo.svg" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
          
           <?php include "nav.php"?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
       <?php include "prof.php" ?>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">

           <?php
            if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result = $conn->query($query);

           if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            $access = $user_data['role'];

            if ($access == 'admin') {
                                                    
            ?>
          <div class="container mt-4">
    <h3>Dashboard</h3>

    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h5>Upcoming Sessions</h5>
            <p>No upcoming sessions.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h5>Request a Session</h5>
            <button class="btn btn-primary"><a href="book" class="text-white">Request</a></button>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h5>Progress Overview</h5>
            <div class="progress">
              <div class="progress-bar" style="width:45%;">45%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

          <?php
            } else if ($access == 'counselor') {?>
                 <div class="container mt-4">

<?php
    $user_id = $_SESSION['user_id'];

// Get counselor_id from user_id
$counselor_res = $conn->query("SELECT counselor_id FROM counselors WHERE user_id=$user_id");
if($counselor_res->num_rows == 0) {
    die("Counselor not found");
}
$counselor_row = $counselor_res->fetch_assoc();
$counselor_id = $counselor_row['counselor_id'];

// Upcoming appointments
$sql = "SELECT a.*, u.full_name AS student_name
        FROM appointments a
        JOIN students s ON a.student_id = s.student_id
        JOIN users u ON s.user_id = u.user_id
        WHERE a.counselor_id = $counselor_id
        AND a.status = 'approved'
        ORDER BY a.appointment_date ASC";
$appointments = $conn->query($sql);

// Pending requests
$pending_sql = "SELECT a.*, u.full_name AS student_name
        FROM appointments a
        JOIN students s ON a.student_id = s.student_id
        JOIN users u ON s.user_id = u.user_id
        WHERE a.counselor_id = $counselor_id
        AND a.status = 'pending'";
$pending_requests = $conn->query($pending_sql);

?>

<h2>Dashboard</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Upcoming Appointments</h5>
                <ul class="list-group">
                    <?php 
                    if($appointments->num_rows>0){
                        while($row=$appointments->fetch_assoc()){
                            echo "<li class='list-group-item'>{$row['appointment_date']} {$row['appointment_time']} - {$row['student_name']}</li>";
                        }
                    } else echo "<li class='list-group-item'>No upcoming appointments</li>";
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Pending Requests</h5>
                <ul class="list-group">
                    <?php 
                    if($pending_requests->num_rows>0){
                        while($row=$pending_requests->fetch_assoc()){
                            echo "<li class='list-group-item'>{$row['appointment_date']} - {$row['student_name']} <a href='appointment_requests.php' class='btn btn-sm btn-primary float-end'>Manage</a></li>";
                        }
                    } else echo "<li class='list-group-item'>No pending requests</li>";
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

              <?php
            }else if ($access == 'student') {?>
                 <div class="container mt-4">
                  <?php
    $user_id = $_SESSION['user_id'];

// Fetch upcoming appointments
$sql = "SELECT * FROM appointments WHERE student_id=$user_id AND appointment_date >= CURDATE() ORDER BY appointment_date ASC";
$appointments = $conn->query($sql);
?>

<h2>Welcome, <?php echo $_SESSION['full_name']; ?></h2>
<h4>Upcoming Appointments</h4>
<table class="table table-bordered">
  <thead>
    <tr><th>Date</th><th>Time</th><th>Counselor</th><th>Status</th></tr>
  </thead>
  <tbody>
    <?php if($appointments->num_rows>0){
      while($row=$appointments->fetch_assoc()){
        echo "<tr>
          <td>{$row['appointment_date']}</td>
          <td>{$row['appointment_time']}</td>
          <td>{$row['counselor_id']}</td>
          <td>{$row['status']}</td>
        </tr>";
      }
    } else {
      echo "<tr><td colspan='4'>No upcoming appointments</td></tr>";
    } ?>
  </tbody>
</table>
              <?php
          }
        }
      }
          ?>


        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>