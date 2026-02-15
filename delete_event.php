<?php
include '../config/db.php';
include '../includes/session.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

$id = $_GET['id'];

$conn->query("DELETE FROM events WHERE id=$id");
$conn->query("DELETE FROM registrations WHERE event_id=$id");

header("Location: dashboard.php");
exit();
?>
