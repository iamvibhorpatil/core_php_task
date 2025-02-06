<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (strtotime($user['last_password_change']) < strtotime('-30 days')) {
    header("Location: change_password.php");
    exit;
}

include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h2>
        <?php if ($user['role'] == 'admin'): ?>
            <a href="create_user.php" class="btn btn-primary">Create User</a>
            <a href="users_list.php" class="btn btn-secondary">Users List</a>
            <a href="admin_tasks_report.php" class="btn btn-success">Task Report</a>
        <?php else: ?>
            <a href="submit_task.php" class="btn btn-success">Submit Task</a>
            <a href="view_tasks.php" class="btn btn-secondary">View Task</a>
        <?php endif; ?>
    </div>
</body>
</html>
