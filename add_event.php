<?php
include '../config/db.php';
include '../includes/session.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_POST['add_event'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $event_date, $location);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<h2>Add Event</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="description" placeholder="Event Description" required></textarea>
    <input type="date" name="event_date" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit" name="add_event">Create Event</button>
</form>

<?php include '../includes/footer.php'; ?>
