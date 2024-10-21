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
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>

</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1> ADMIN</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="" method="post">
                <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN IN</h3>
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" autofocus required>
                </div>

                <div class="mb-3">
                    <label class="form-label">PASSWORD</label>

                    <div class="input-group mb-3">
                        <input class="form-control" type="password" id="myInput" name="password" required />
                        <span class="input-group-text" onclick="myFunction()" style="cursor: pointer;">
                            <i class="bi bi-eye-slash-fill" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>
                <script>
                function myFunction() {
                    var x = document.getElementById("myInput");
                    var y = document.getElementById("eyeIcon");

                    if (x.type === "password") {
                        x.type = "text";
                        y.className = "bi-eye-fill";
                    } else {
                        x.type = "password";
                        y.className = "bi-eye-slash-fill";
                    }
                }
                </script>
                <div class="mb-3 btn-container d-grid">
                    <button class="btn btn-primary btn-block" name="login_btn" type="submit"><i
                            class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN IN</button>
                </div>
            </form>
            <?php
      require_once('../parts/db.php');
      if (isset($_POST['login_btn'])) {
        $email =  $_POST['email'];
        $password =  $_POST['password'];

        $select = "SELECT * FROM admin WHERE admin_email='$email'";
        $run =  mysqli_query($conn, $select);
        if (mysqli_num_rows($run) > 0) {

          $row =  mysqli_fetch_array($run);


          $admin_email =  $row['admin_email'];
          $admin_password =  $row['admin_password'];
          $admin_role =  $row['admin_role'];

          if ($email ==   $admin_email && $password ==  $admin_password) {
            //header('Location:index.php');
            echo "<script>window.open('dashboard.php','_self');</script>";
            echo $_SESSION['admin_email'] =  $admin_email;
            echo $_SESSION['admin_role'] =  $admin_role;
          } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>

 Invalid Login.
</div>";
          }
        } else {
          echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>

 No Email Found.
</div>";
        }
      }


      ?>

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