<?php
include "database.php";

// Handle form submission
if(isset($_POST['conduct'])){
    $appointment_id = intval($_POST['appointment_id']);
    $student_id = intval($_POST['student_id']);
    $session_date = $_POST['session_date'];
    $session_time = $_POST['session_time'];
    $notes = $conn->real_escape_string($_POST['session_notes']);
    $recommendation = $conn->real_escape_string($_POST['recommendation']);
    $outcome = $_POST['outcome'];

    $insert_sql = "
        INSERT INTO sessions 
        (appointment_id, counselor_id, student_id, session_date, session_time, session_notes, recommendation, outcome, created_at)
        VALUES
        ($appointment_id, $counselor_id, $student_id, '$session_date', '$session_time', '$notes', '$recommendation', '$outcome', NOW())
    ";

    if($conn->query($insert_sql)){
        // Update appointment status if needed
        $conn->query("UPDATE appointments SET status='completed' WHERE appointment_id=$appointment_id");

            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>
                swal({
                    title: "Successful",
                    text: "Redirecting...",
                    icon: "success",
                    buttons: false,
                    timer: 2000
                });

                setTimeout(function() {
                    window.location.href = "conduct";
                }, 2000);
            </script>';

        // Redirect based on outcome
        switch($outcome){
            case 'resolved':
                header("Refresh:2; url=dashboard.php");
                break;
            case 'ongoing':
                header("Refresh:2; url=schedule_followup.php?student_id=$student_id");
                break;
            case 'referred':
                header("Refresh:2; url=referral.php?student_id=$student_id");
                break;
        }
    } else {
        echo "<div class='alert alert-danger'>Error conducting session: ".$conn->error."</div>";
    }
}

?>