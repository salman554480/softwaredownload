<?php require_once('parts/top.php'); ?>

</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-heart-pulse"></i> Add platform</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Name</b></label>
                                    <input class="form-control" name="platform_name" type="text" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Add Record">
                                </div>
                            </div>
                        </form>

                        <?php
                        require_once('../parts/db.php');
                        if (isset($_POST['insert_btn'])) {

                            $platform_name = $_POST['platform_name'];


                            $insert_platform = "INSERT INTO platform(platform_name)VALUES('$platform_name')";

                            $run_platform = mysqli_query($conn, $insert_platform);

                            if ($run_platform == true) {


                                echo "<script>alert('Record Added');</script>";
                                echo "<script>
                                    setTimeout(function() {
                                        window.open('index.php', '_self');
                                    }, 2000);
                                </script>";
                            } else {
                                //echo "fail";
                                echo "<script>alert('Failed');</script>";
                            }
                        }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <?php require_once('parts/footer.php'); ?>