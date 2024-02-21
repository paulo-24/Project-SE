<?php
include("php/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_id'])) {
    $admin_id = $_POST['admin_id'];
    $fullname = $_POST['fname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // New password
    $gender = $_POST['gender'];

    // Check if a new password was provided
    if (!empty($password)) {
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update the admin data in the database with the new hashed password
        $query = "UPDATE admin SET fname=?, username=?, email=?, password=?, gender=? WHERE id=?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $fullname, $username, $email, $hashed_password, $gender, $admin_id);
        mysqli_stmt_execute($stmt);
    } else {
        // Update the admin data in the database without changing the password
        $query = "UPDATE admin SET fname=?, username=?, email=?, gender=? WHERE id=?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $fullname, $username, $email, $gender, $admin_id);
        mysqli_stmt_execute($stmt);
    }

    // Redirect back to admin list after update
    header("Location: admin_user.php");
    exit;
} else {
    // Invalid request, redirect back to admin list
    header("Location: admin_user.php");
    exit;
}
?>
