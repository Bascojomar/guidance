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

          <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Counseling Reports</h4>
        </div>

        <div class="card-body">
<?php

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

$sql = "SELECT 
            u.full_name AS student_name, 
            sess.session_date, 
            sess.session_notes, 
            sess.recommendation, 
            sess.outcome
        FROM sessions sess
        JOIN students s ON sess.student_id = s.student_id
        JOIN users u ON s.user_id = u.user_id
        WHERE MONTH(sess.session_date) = '$month' 
        AND YEAR(sess.session_date) = '$year'";

$result = $conn->query($sql);
?>

<h2>Reports</h2>
<form method="GET" class="row g-3 mb-3">
    <div class="col-md-3">
        <label>Month</label>
        <input type="number" name="month" class="form-control" value="<?php echo $month; ?>" min="1" max="12">
    </div>
    <div class="col-md-3">
        <label>Year</label>
        <input type="number" name="year" class="form-control" value="<?php echo $year; ?>" min="2020" max="2100">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<!-- View PDF in browser -->
<a href="view.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>&view=1" 
   class="btn btn-info mb-3" target="_blank">
   View PDF
</a>

<table class="table table-bordered" id="reportsTable">
<thead>
<tr>
    <th>Student</th>
    <th>Date</th>
    <th>Notes</th>
    <th>Recommendation</th>
    <th>Outcome</th>
</tr>
</thead>
<tbody>
<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
            <td>{$row['student_name']}</td>
            <td>{$row['session_date']}</td>
            <td>{$row['session_notes']}</td>
            <td>{$row['recommendation']}</td>
            <td>{$row['outcome']}</td>
        </tr>";
    }
}
?>
</tbody>
</table>

<?php if($result->num_rows == 0) {
    echo "<div class='alert alert-warning'>No records found for selected month/year.</div>";
} ?>


        </div>
    </div>
        </div>
      </div>
      
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#reportsTable').DataTable({
        "paging": true,        // Enable pagination
        "lengthChange": true,  // Allow changing number of rows
        "searching": true,     // Enable search box
        "ordering": true,      // Enable column sorting
        "info": true,          // Show info about table
        "autoWidth": false,    // Disable auto column width
        "pageLength": 10       // Default rows per page
    });
});
</script>
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

</body>

</html>