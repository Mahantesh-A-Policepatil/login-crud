
<!doctype html>
<?php session_start(); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Signin Template for Bootstrap</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">    
  </head>
  <body>
    <?php
      include("../config/connection.php");
      include ('../layout/header.php');

      if(isset($_POST['submit'])) {
        $user = mysqli_real_escape_string($mysqli, $_POST['username']);
        $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

        if($user == "" || $pass == "") {
          echo "Either username or password field is empty.";
          echo "<br/>";
          echo "<a href='login.php'>Go back</a>";
        } else {
          $result = mysqli_query($mysqli, "SELECT * FROM users WHERE user_name='$user' AND password=md5('$pass')")
                or die("Could not execute the select query.");
          
          $row = mysqli_fetch_assoc($result);

          if(is_array($row) && !empty($row)) {
            $validuser = $row['user_name'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
          } else {
            echo "Invalid username or password.";
            echo "<br/>";
            echo "<a href='../login/login.php'>Go back</a>";
          }

          if(isset($_SESSION['valid'])) {
            header('Location: ../product/view.php');     
          }
        }
      } else {
    ?>
    <h1 class="text-center text-info" style="margin-top:120px;">Login</h1>
    <div class="container" style="border: 4px solid black; padding:20px;">
      <form id="login-form" name="form1" class="form" action="" method="post">
          
          <div class="form-group">
              <label for="username" class="text-info">Username:</label>
              <input type="text" name="username" id="username" class="form-control">
          </div>
          <div class="form-group">
              <label for="password" class="text-info">Password:</label>
              <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
              <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
              
          </div>       
      </form>
    </div>
    <span class="text-center text-info" style="color:black; margin-left:700px; margin-top:50px">Not Registered..? 
      <a href="register.php">Register</a>
    </span>
  <?php
    }
    include '../layout/footer.php'
  ?>
  </body>
</html>
