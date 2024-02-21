<?php 
session_start();
include("php/database.php");

// Check if all required fields are set
if(isset($_POST['name'], $_POST['employee_id'], $_POST['email'], $_POST['gender'], $_POST['department'], $_POST['salary'], $_POST['start_date'])) {

    $name = $_POST['name'];
    $employee_id = $_POST['employee_id'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $department = implode(',', (array)$_POST['department']); // Convert to array to ensure it's always an array
    $salary = $_POST['salary'];
    $start_date = $_POST['start_date'];

    // Prepare and bind statement
    $stmt = $connection->prepare("INSERT INTO employees (name, employee_id, email, gender, department, salary, start_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $employee_id, $email, $gender, $department, $salary, $start_date);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to positionlist.php upon successful insertion
        header("Location: positionlist.php");
        exit();
    } else {
        echo "Error: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "All fields are required";
}

$connection->close();
?>
