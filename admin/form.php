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
                <h1><i class="bi bi-heart-pulse"></i> Add ECG</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Title</b></label>
                                    <input class="form-control" name="ecg_title" type="text" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Level</b></label>
                                    <select type="text" class="form-control" name="ecg_level">
                                        <option>Beginner</option>
                                        <option>Technician</option>
                                        <option>Nurse</option>
                                        <option>Resident</option>
                                        <option>Fellow</option>
                                        <option>Physician</option>
                                        <option>Specialist</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label class="form-label"><b>Explanation</b></label>
                                    <textarea class="form-control" name="ecg_exp" required></textarea>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Image</b></label>
                                    <input class="form-control" name="ecg_image" type="file">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Visual Explaination</b></label>
                                    <input class="form-control" name="ecg_exp_img" type="file">
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

                            $ecg_title = $_POST['ecg_title'];
                            $ecg_image = $_FILES['ecg_image']['name'];
                            $ecg_tmp_name = $_FILES['ecg_image']['tmp_name'];
                            $ecg_level = $_POST['ecg_level'];
                            $ecg_exp = str_replace("'", "\'", $_POST['ecg_exp']);

                            $timestamp = time();
                            $image_extension = pathinfo($ecg_image, PATHINFO_EXTENSION);
                            $formatted_category_title = strtolower(str_replace(' ', '_', $ecg_title));
                            $ecg_image = $timestamp . '_' . $formatted_category_title . '.' . $image_extension;


                            $insert_ecg = "INSERT INTO ecg(ecg_title,ecg_image,ecg_level,ecg_explanation,ecg_explanation_img)VALUES('$ecg_title','$ecg_image','$ecg_level','$ecg_exp','$ecg_exp_img')";

                            $run_ecg = mysqli_query($conn, $insert_ecg);

                            if ($run_ecg == true) {
                                move_uploaded_file($ecg_tmp_name, "upload/$ecg_image");
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