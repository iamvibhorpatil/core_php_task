<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>My Submitted Tasks</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Start Time</th>
                    <th>Stop Time</th>
                    <th>Notes</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM tasks WHERE user_id = ? ORDER BY start_time DESC";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $count = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$count}</td>
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
