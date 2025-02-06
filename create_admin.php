<?php
require 'db.php'; // Make sure this file connects to your MySQL database

// Hash the password securely using bcrypt
$password = password_hash("password", PASSWORD_BCRYPT);

// Prepare SQL query to insert the admin user
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, password, role, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, NOW())");

// Bind parameters for the query
$stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $password, $role);

// Set values for the parameters
$first_name = "Admin";
$last_name = "User";
$email = "admin@test.com";
$phone = "1234567890";
$role = "admin"; // Admin role

// Execute the statement
$stmt->execute();

// Close the statement and connection
$stmt->close();
$conn->close();

// Confirm user creation
echo "Admin user created successfully!";
?>
