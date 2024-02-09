<?php
  session_start();
  
  include("php/database.php");

  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO admin (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$hashed_password')";
      mysqli_query($connection, $sql);

      header("Location: loginpage.php");
      exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/signuppage.css">
</head>
<body>
    <div class="wrapper">
        <form action="signuppage.php" method="post">
            <h1>Login Panel</h1>
            <h3>Enter username & password</h3>

            <div class="input-box">
                <input name="fname" type="text" placeholder="First Name" required>
                <input name="lname" type="text" placeholder="Last Name" required>
            </div>

            <div class="input-box">
                <input class="input_email" type="email" placeholder="Email" name="email" required>
                <input class="password_input" type="password" placeholder="Password" name="password" required>
                <input class="signup" type="submit" value="Sign Up">
            </div>
        </form>
        <p>Already have an account? <a href="loginpage.php"><span>Log in here</span></a></p>
    </div>
</body>
</html>
