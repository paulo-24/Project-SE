<?php
  session_start();
  // Include database connection file
  include("php/database.php");

  // Check if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve form data
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Query the database to check if the user exists and the password is correct
      $query = "SELECT * FROM admin WHERE username = '$username'";
      $result = mysqli_query($connection, $query);

      if ($result && mysqli_num_rows($result) > 0) {
          $user = mysqli_fetch_assoc($result);
          if (password_verify($password, $user['password'])) {
              // Password is correct, set session variables and redirect to dashboard
              $_SESSION['username'] = $username;
              header("Location: index.html");
              exit;
          } else {
              // Password is incorrect
              $error = "Invalid password";
          }
      } else {
          // User not found
          $error = "User not found";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/css/loginpage.css"/>
  </head>

  <body>
    <div class="wrapper">
      <form action="index.html" method="post">
        <h1>Login</h1>

        <?php if (isset($error)) { ?>
          <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <div class="input-box">
          <input type="text" name="username" placeholder="Username" required />
          <i class="bx bxs-user"></i>
        </div>

        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required />
          <i class="bx bxs-lock-alt"></i>
        </div>

        <button type="submit" class="btn">Login</button>
      </form>
    </div>
  </body>
</html>
