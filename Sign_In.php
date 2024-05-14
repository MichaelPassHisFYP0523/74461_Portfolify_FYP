<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <link href="css/tooplate-gotto-job.css" rel="stylesheet">

</head>

<body class="login-page">
  <div class="login-container">
    <h2>Portfolify</h2>
    <?php
      if(isset($_GET['error'])) {
          $error = $_GET['error'];
          if($error === "InvalidCredentials") {
              echo "<p class='error-message'>Invalid email or password. Please try again.</p>";
          } elseif($error === "UserNotFound") {
              echo "<p class='error-message'>User not found. Please register first.</p>";
          }
      }
    ?>
    <form id="loginForm" action="user_login.php" method="POST">
      <input type="text" placeholder="Email" id="email" name="email" required>
      <input type="password" placeholder="Password" id="password" name="password" required>
      <button type="submit" id="loginBtn">Login</button>
    </form>

      <p>Do not have an account? <a href="Sign_Up.html">Register here!</a></p>

  </div>

</body>
</html>