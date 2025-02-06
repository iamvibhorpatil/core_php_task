<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tasks Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tasks Report</h2>
        <a href="export_tasks.php" class="btn btn-success mb-3">Export to CSV</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Start Time</th>
                    <th>Stop Time</th>
                    <th>Notes</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT tasks.*, users.first_name, users.last_name 
                          FROM tasks 
                          JOIN users ON tasks.user_id = users.id 
                          ORDER BY tasks.start_time DESC";
                $result = $conn->query($query);
                $count = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['start_time']}</td>
                        <td>{$row['stop_time']}</td>
                        <td>{$row['notes']}</td>
                        <td>{$row['description']}</td>
                    </tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
