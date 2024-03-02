<?php
session_start();
include 'database.php';

if (isset($_POST['time_in'])) {
    $employee_id = $_SESSION['employee_id'];
    $time_in = date('H:i:s');
    $image_data = $_POST['image_data'];

    // Save the image to the file system
    $file_name = 'employee_Photo/' . uniqid() . '.jpeg';
    if (move_uploaded_file($image_data, $file_name)) {
        // Save the attendance record to the database
        $query = "INSERT INTO attendance (employee_id, time_in, image) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'iss', $employee_id, $time_in, $file_name);
        if (mysqli_stmt_execute($stmt)) {
            echo 'Time-in recorded successfully';
        } else {
            echo 'Failed to record time-in';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'Failed to save image';
    }
}
?>