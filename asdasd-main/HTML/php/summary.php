<?php
  include("database.php");

  $sql = "CALL GetUserSummary()";
  $result = mysqli_query($conn, $sql);

  // Fetch data as an associative array
  $data = [];

  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }

  // Encode data as JSON and send it to the client
  header('Content-Type: application/json');
  echo json_encode($data);  // Echo the JSON data

  // Close the database connection
  $conn->close();
?>
