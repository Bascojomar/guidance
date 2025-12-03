<?php
include "backend/database.php";
include "backend/session.php";
include "backend/function.php";

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free Bootstrap Admin Template by Adminmart</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

        <?php include "nav.php" ?>
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
          $status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$date_filter = isset($_GET['date']) ? $_GET['date'] : '';

$where = [];
if($status_filter) $where[] = "status='$status_filter'";
if($date_filter) $where[] = "appointment_date='$date_filter'";
$where_sql = $where ? "WHERE ".implode(' AND ', $where) : "";

$sql = "
    SELECT 
        a.*, 
        u.full_name AS student_name, 
        c.department AS counselor_name
    FROM appointments a
    JOIN students s ON a.student_id = s.student_id
    JOIN users u ON s.user_id = u.user_id
    JOIN counselors c ON a.counselor_id = c.counselor_id
    $where_sql
    ORDER BY a.appointment_date DESC
";

$appointments = $conn->query($sql);

?>

<h2>All Appointments</h2>

<form method="GET" class="row g-3 mb-3">
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">-- Filter by Status --</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="date" class="form-control" placeholder="Filter by Date">
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<table class="table table-bordered">
<thead>
<tr><th>ID</th><th>Student</th><th>Counselor</th><th>Date</th><th>Time</th><th>Concern</th><th>Status</th></tr>
</thead>
<tbody>
<?php
if($appointments->num_rows>0){
    while($row=$appointments->fetch_assoc()){
        echo "<tr>
        <td>{$row['appointment_id']}</td>
        <td>{$row['student_name']}</td>
        <td>{$row['counselor_name']}</td>
        <td>{$row['appointment_date']}</td>
        <td>{$row['appointment_time']}</td>
        <td>{$row['concern_type']}</td>
        <td>{$row['status']}</td>
        </tr>";
    }
} else echo "<tr><td colspan='7'>No appointments found</td></tr>";
?>
</tbody>
</table>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

      <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/js/sidebarmenu.js"></script>
      <script src="../assets/js/app.min.js"></script>
      <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="../assets/js/dashboard.js"></script>
      <!-- solar icons -->
      <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

      <?php include "backend/book.php"; ?>
</body>

</html>