<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['prompt_password_change']) && $_SESSION['prompt_password_change'] == true) {
    unset($_SESSION['prompt_password_change']);
    $_SESSION['password_change_alert'] = true;
} else {
     $_SESSION['no_password_change_alert'] = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_id = $_SESSION['user_id'];

    $updateQuery = "UPDATE users SET password = ?, last_password_change = NOW() WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $new_password, $user_id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .disabled-input, .disabled-button {
            background-color: #e9ecef!important;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Change Password</h2>

        <?php if (isset($_SESSION['no_password_change_alert']) && $_SESSION['no_password_change_alert'] == true): ?>
            <div class="alert alert-warning" role="alert">
                Your password has not been changed for more than 30 days. You are not required to update it right now, but please do so soon.
            </div>
            <?php unset($_SESSION['no_password_change_alert']); ?>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>New Password</label>
                <input type="password" name="password" class="form-control <?php echo (isset($_SESSION['no_password_change_alert']) && $_SESSION['no_password_change_alert'] == true) ? 'disabled-input' : ''; ?>" 
                    <?php echo (isset($_SESSION['no_password_change_alert']) && $_SESSION['no_password_change_alert'] == true) ? 'disabled' : ''; ?>>
            </div>
            <button type="submit" class="btn btn-primary <?php echo (isset($_SESSION['no_password_change_alert']) && $_SESSION['no_password_change_alert'] == true) ? 'disabled-button' : ''; ?>" 
                <?php echo (isset($_SESSION['no_password_change_alert']) && $_SESSION['no_password_change_alert'] == true) ? 'disabled' : ''; ?>>
                Change Password
            </button>
        </form>
    </div>

    <script>
        <?php if (isset($_SESSION['password_change_alert']) && $_SESSION['password_change_alert'] == true): ?>

            Swal.fire({
                icon: 'warning',
                title: 'Password Change Required',
                text: 'Your password has not been changed for more than 30 days. Please update it now.',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['password_change_alert']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
