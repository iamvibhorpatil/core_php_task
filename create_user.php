<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

function generatePassword($length = 8) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()"), 0, $length);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = 'user';
    
    $password = !empty($_POST['auto_generate']) ? generatePassword() : $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (first_name, last_name, email, phone, password, role, last_password_change) VALUES (?, ?, ?, ?, ?, ?, NULL)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $hashed_password, $role);
    
    if ($stmt->execute()) {
        $success = "User created successfully! Generated Password: " . $password;
    } else {
        $error = "Error creating user.";
    }
}
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create User</h2>
        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>
                    <input type="checkbox" name="auto_generate" id="auto_generate"> Auto Generate Password
                </label>
            </div>
            <div class="mb-3" id="password_field">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    <script>
        document.getElementById('auto_generate').addEventListener('change', function() {
            document.getElementById('password_field').style.display = this.checked ? 'none' : 'block';
        });
    </script>
</body>
</html>
