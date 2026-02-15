<?php
include '../config/db.php';
include '../includes/session.php';

// Allow only admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

// Get analytics data
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$total_events = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
$events = $conn->query("SELECT * FROM events");
$total_registrations = $conn->query("SELECT COUNT(*) AS total FROM registrations")->fetch_assoc()['total'];
?>

<?php include '../includes/header.php'; ?>

<h2>Admin Dashboard</h2>

<h3>Manage Events</h3>

<?php while ($event = $events->fetch_assoc()) { ?>
    <div class="card">
        <h4><?php echo $event['title']; ?></h4>
        <a href="delete_event.php?id=<?php echo $event['id']; ?>">Delete</a>
    </div>
<?php } ?>


<a href="../logout.php">Logout</a>
<a href="add_event.php">Add New Event</a>
<a href="view_registrations.php">View Registrations</a>


<div class="stats">
    <div class="stat-box">
        <h3>Total Users</h3>
        <p><?php echo $total_users; ?></p>
    </div>

    <div class="stat-box">
        <h3>Total Events</h3>
        <p><?php echo $total_events; ?></p>
    </div>

    <div class="stat-box">
        <h3>Total Registrations</h3>
        <p><?php echo $total_registrations; ?></p>
    </div>
</div>

<canvas id="statsChart"></canvas>

<script>
const ctx = document.getElementById('statsChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Users', 'Events', 'Registrations'],
        datasets: [{
            label: 'System Statistics',
            data: [<?php echo $total_users; ?>,
                   <?php echo $total_events; ?>,
                   <?php echo $total_registrations; ?>]
        }]
    }
});
</script>


<?php include '../includes/footer.php'; ?>
