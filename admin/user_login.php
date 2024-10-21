<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Login</title>
</head>

<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <div class="logo">
      <h1>ECG</h1>
    </div>
    <div class="login-box">
      <form class="login-form" action="" method="post">
        <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN IN</h3>
        <div class="mb-3">
          <label class="form-label">EMAIL</label>
          <input class="form-control" type="text" name="email" placeholder="Email" autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">PASSWORD</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="mb-3 btn-container d-grid">
          <button class="btn btn-primary btn-block" name="login_btn" type="submit"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN IN</button>
        </div>
      </form>
      <?php
      require_once('parts/db.php');
      if (isset($_POST['login_btn'])) {
        $email =  $_POST['email'];
        $password =  $_POST['password'];

        $select = "SELECT * FROM user WHERE user_email='$email'";
        $run =  mysqli_query($conn, $select);
        if (mysqli_num_rows($run) > 0) {

          $row =  mysqli_fetch_array($run);


          $user_email =  $row['user_email'];
          $user_password =  $row['user_password'];

          if ($email ==   $user_email && $password ==  $user_password) {
            //header('Location:index.php');
            echo "<script>window.open('dashboard.php','_self');</script>";
            echo $_SESSION['user_email'] =  $user_email;
          } else {
            echo "Invalid Login";
          }
        } else {
          echo "No Email Found";
        }
      }


      ?>
      <form class="forget-form" action="index.html">
        <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Forgot Password ?</h3>
        <div class="mb-3">
          <label class="form-label">EMAIL</label>
          <input class="form-control" type="text" placeholder="Email">
        </div>
        <div class="mb-3 btn-container d-grid">
          <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>RESET</button>
        </div>
        <div class="mb-3 mt-3">
          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="bi bi-chevron-left me-1"></i> Back to Login</a></p>
        </div>
      </form>
    </div>
  </section>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
      $('.login-box').toggleClass('flipped');
      return false;
    });
  </script>
</body>

</html>