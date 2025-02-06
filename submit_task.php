<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
include 'sidebar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $start_time = $_POST['start_time'];
    $stop_time = $_POST['stop_time'];
    $notes = $_POST['notes'];
    $description = $_POST['description'];

    $query = "INSERT INTO tasks (user_id, start_time, stop_time, notes, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $user_id, $start_time, $stop_time, $notes, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Task submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting task!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Submit Task</h2>
        <form method="post">
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stop_time" class="form-label">Stop Time</label>
                <input type="datetime-local" name="stop_time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Task</button>
        </form>
    </div>
</body>
</html>
