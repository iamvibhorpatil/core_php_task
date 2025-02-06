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
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Users List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last Login</th>
                    <th>Last Password Change</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM users WHERE role = 'user'";
                $result = $conn->query($query);
                $count = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['last_login']}</td>
                        <td>{$row['last_password_change']}</td>
                    </tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
