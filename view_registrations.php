<?php
include '../config/db.php';
include '../includes/session.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

$query = "
SELECT users.name, users.email, events.title
FROM registrations
JOIN users ON registrations.user_id = users.id
JOIN events ON registrations.event_id = events.id
ORDER BY events.title
";

$result = $conn->query($query);
?>

<?php include '../includes/header.php'; ?>

<h2>Event Registrations</h2>

<?php
while ($row = $result->fetch_assoc()) {
?>
    <div class="card">
        <p><strong>Event:</strong> <?php echo $row['title']; ?></p>
        <p><strong>Student:</strong> <?php echo $row['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    </div>
<?php
}
?>

<?php include '../includes/footer.php'; ?>
