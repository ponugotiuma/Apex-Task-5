<?php
include 'config/db.php';
include 'includes/session.php';

if (isset($_POST['register_event'])) {

    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];

    // Check duplicate registration
    $check = $conn->prepare("SELECT id FROM registrations WHERE user_id=? AND event_id=?");
    $check->bind_param("ii", $user_id, $event_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "You already registered for this event!";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO registrations (user_id, event_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>
