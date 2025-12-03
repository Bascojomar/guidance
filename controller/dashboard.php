<?php


session_start();

if ($_SESSION['role'] == 'admin') {
    require "view/dashboard.php";
} else if ($_SESSION['role'] == 'counselor' || $_SESSION['role'] == 'student') {
    require "view/dashboard.php";
}
?>