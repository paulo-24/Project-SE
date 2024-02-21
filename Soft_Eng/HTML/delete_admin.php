<?php
include("php/database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Delete the admin from the database
    $query = "DELETE FROM admin WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $admin_id);
    mysqli_stmt_execute($stmt);

    // Redirect back to admin list after deletion
    header("Location: admin_user.php");
    exit;
} else {
    // Invalid request, redirect back to admin list
    header("Location: admin_user.php");
    exit;
}
?>
