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
<h2>Manage Users</h2>
<!-- Add User Form -->
<form method="POST" class="mb-4 row g-3">
    <div class="col-md-2"><input type="text" name="full_name" class="form-control" placeholder="Full Name" required></div>
    <div class="col-md-2"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
    <div class="col-md-2"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
    <div class="col-md-2"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
    <div class="col-md-2">
        <!-- First dropdown -->
<select name="role" id="roleSelect" class="form-select" required>
    <option value="">Select Role</option>
    <option value="student">Student</option>
    <option value="counselor">Counselor</option>
</select>
<br>

<!-- Second dropdown (hidden by default) -->
<select name="roleCounselor" id="counselorSelect" class="form-select" style="display:none;" required>
    <option value="">Select Counselor Type</option>
    <option value="Guidance Office">Guidance Office</option>
    <option value="Student Support">Student Support</option>
</select>

<script>
// Show/hide second dropdown based on first dropdown selection
document.getElementById('roleSelect').addEventListener('change', function() {
    const counselorSelect = document.getElementById('counselorSelect');
    if (this.value === 'counselor') {
        counselorSelect.style.display = 'block';
        counselorSelect.required = true; // make it required only when visible
    } else {
        counselorSelect.style.display = 'none';
        counselorSelect.required = false;
    }
});
</script>

    </div>
    <div class="col-md-2"><button type="submit" name="add" class="btn btn-success">Add User</button></div>
</form>

<!-- Users Table -->
<table class="table table-bordered">
<thead>
<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Username</th><th>Role</th><th>Action</th></tr>
</thead>
<tbody>
<?php
$users = $conn->query("SELECT * FROM users WHERE role!='admin'");

if($users->num_rows>0){
    while($row=$users->fetch_assoc()){
        echo "<tr>
        <td>{$row['user_id']}</td>
        <td>{$row['full_name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['username']}</td>
        <td>{$row['role']}</td>
        <td><a href='manage_users.php?delete={$row['user_id']}' class='btn btn-danger btn-sm'>Delete</a></td>
        </tr>";
    }
} else echo "<tr><td colspan='6'>No users found</td></tr>";
?>
</tbody>
</table>
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

      <?php include "backend/verify.php"; ?>
</body>

</html>