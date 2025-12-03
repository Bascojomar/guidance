<?php
// Add user
if(isset($_POST['add'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Insert into users table
    $stmt = $conn->prepare("INSERT INTO users (username, password, full_name, email, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $full_name, $email, $role);
    $stmt->execute();

    // Get the last inserted user_id
    $user_id = $conn->insert_id;

    // If role is counselor, insert into counselors table
    if($role === 'counselor') {
        $department = $_POST['roleCounselor']; // selected counselor department
        $stmt2 = $conn->prepare("INSERT INTO counselors (user_id, department) VALUES (?, ?)");
        $stmt2->bind_param("is", $user_id, $department);
        $stmt2->execute();
        $stmt2->close();
    }

    $stmt->close();

    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
echo '<script>
    swal({
        title: "Add Successful",
        text: "Redirecting...",
        icon: "success",
        buttons: false,
        timer: 2000
    });

    setTimeout(function() {
        window.location.href = "manage_user";
    }, 2000);
</script>';
}


// Delete user
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE user_id=$id");

        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
echo '<script>
    swal({
        title: "Delete Successful",
        text: "Redirecting...",
        icon: "success",
        buttons: false,
        timer: 2000
    });

    setTimeout(function() {
        window.location.href = "manage_user";
    }, 2000);
</script>';
}
?>