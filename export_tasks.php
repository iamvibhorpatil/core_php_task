<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=tasks_report.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Start Time', 'Stop Time', 'Notes', 'Description']);

$query = "SELECT start_time, stop_time, notes, description FROM tasks ORDER BY start_time DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['start_time'], $row['stop_time'], $row['notes'], $row['description']]);
}

fclose($output);
exit;
