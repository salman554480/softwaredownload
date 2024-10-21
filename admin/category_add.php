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
                <h1><i class="bi bi-heart-pulse"></i> Add Category</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Level</b></label>
                                    <select class="form-control" name="platform_id">
                                        <?php
                                        $select_platform =  "SELECT * FROM platform";
                                        $select_platform_result = mysqli_query($conn, $select_platform);
                                        while ($row_platform = mysqli_fetch_assoc($select_platform_result)) {
                                            $platform_id = $row_platform['platform_id'];
                                            $platform_name = $row_platform['platform_name'];
                                        ?>
                                        <option value="<?php echo $platform_id; ?>"><?php echo $platform_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Name</b></label>
                                    <input class="form-control" name="category_name" type="text" required>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label class="form-label"><b>Description</b></label>
                                    <textarea class="form-control" name="category_description" required></textarea>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Image</b></label>
                                    <input class="form-control" name="category_image" type="file">
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

                            $platform_id = $_POST['platform_id'];
                            $category_name = $_POST['category_name'];
                            $category_image = $_FILES['category_image']['name'];
                            $category_tmp_name = $_FILES['category_image']['tmp_name'];
                            $category_description = str_replace("'", "\'", $_POST['category_description']);


                            $insert_category = "INSERT INTO category(platform_id,category_name,category_image,category_description)VALUES('$platform_id','$category_name','$category_image','$category_description')";

                            $run_category = mysqli_query($conn, $insert_category);

                            if ($run_category == true) {
                                move_uploaded_file($category_tmp_name, "../assets/img/category/$category_image");
                                echo "<div class='bg-success text-light p-1'>Record Inserted</div>";
                                echo "<script>
                                    setTimeout(function() {
                                        window.open('category_add.php', '_self');
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