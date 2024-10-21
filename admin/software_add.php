<?php require_once('parts/top.php'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>


</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-heart-pulse"></i> Add Software</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-4 mt-3">
                                    <label class="form-label"><b>Platform</b></label>
                                    <select class="form-control" name="platform_id" required>
                                        <option value="">Select Platform</option>
                                        <?php
                                        $select_platform = "SELECT * FROM platform";
                                        $select_platform_result = mysqli_query($conn, $select_platform);
                                        while ($row_platform = mysqli_fetch_assoc($select_platform_result)) {
                                            echo '<option value="' . $row_platform['platform_id'] . '">' . $row_platform['platform_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label"><b>Category</b></label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php
                                        $select_category = "SELECT * FROM category";
                                        $select_category_result = mysqli_query($conn, $select_category);
                                        while ($row_category = mysqli_fetch_assoc($select_category_result)) {
                                            echo '<option value="' . $row_category['category_id'] . '">' . $row_category['category_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label"><b>License</b></label>
                                    <select class="form-control" name="license_id" required>
                                        <option value="">Select License</option>
                                        <?php
                                        $select_license = "SELECT * FROM license";
                                        $select_license_result = mysqli_query($conn, $select_license);
                                        while ($row_license = mysqli_fetch_assoc($select_license_result)) {
                                            echo '<option value="' . $row_license['license_id'] . '">' . $row_license['license_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label class="form-label"><b>Software Name</b></label>
                                    <input class="form-control" name="software_name" type="text" required>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label class="form-label"><b>Description</b></label>
                                    <textarea class="form-control editor" id="editor1" name="software_description"
                                        required></textarea>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Software Icon</b></label>
                                    <input class="form-control" name="software_icon" type="file" accept="image/*">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Publisher</b></label>
                                    <input class="form-control" name="software_publisher" type="text" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Release Date</b></label>
                                    <input class="form-control" name="release_date" type="date" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Official Website</b></label>
                                    <input class="form-control" name="official_website" type="url" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Meta Title</b></label>
                                    <input class="form-control" name="meta_title" type="text" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Meta Keyword</b></label>
                                    <input class="form-control" name="meta_keyword" type="text" required>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label class="form-label"><b>Meta Description</b></label>
                                    <textarea class="form-control" name="meta_description"></textarea>
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
                            $category_id = $_POST['category_id'];
                            $license_id = $_POST['license_id'];
                            $software_name = $_POST['software_name'];
                            $software_description = str_replace("'", "\'", $_POST['software_description']);
                            $software_publisher = $_POST['software_publisher'];
                            $release_date = $_POST['release_date'];
                            $official_website = $_POST['official_website'];

                            $software_icon = $_FILES['software_icon']['name'];
                            $icon_tmp_name = $_FILES['software_icon']['tmp_name'];

                            $meta_title = $_POST['meta_title'];
                            $meta_keyword = $_POST['meta_keyword'];
                            $meta_description = $_POST['meta_description'];


                            $timestamp = time();
                            $icon_extension = pathinfo($software_icon, PATHINFO_EXTENSION);
                            $formatted_software_name = strtolower(str_replace(' ', '_', $software_name));
                            $software_icon = $timestamp . '_' . $formatted_software_name . '.' . $icon_extension;

                            // Prepare the insert statement
                            $insert_software = "INSERT INTO software(platform_id, category_id, license_id, software_name, software_description, software_icon, software_publisher, release_date, official_website) 
                        VALUES('$platform_id', '$category_id', '$license_id', '$software_name', '$software_description', '$software_icon', '$software_publisher', '$release_date', '$official_website')";

                            // Execute the query
                            $run_software = mysqli_query($conn, $insert_software);

                            if ($run_software) {

                                $select_software = "SELECT * FROM software WHERE software_name='$software_name'";
                                $run_select_software =  mysqli_query($conn, $select_software);
                                $row_software = mysqli_fetch_array($run_select_software);
                                $software_id =  $row_software['software_id'];

                                

                                move_uploaded_file($icon_tmp_name, "../assets/img/software/$software_icon");
                                echo "<div class='bg-success text-light p-1'>Record Inserted</div>";
                                echo "<script>
                                    setTimeout(function() {
                                        window.open('software_add.php', '_self');
                                    }, 2000);
                                </script>";
                            } else {
                                echo "<script>alert('Failed to insert record');</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    document.querySelectorAll('.editor').forEach(editorElement => {
        ClassicEditor
            .create(editorElement)
            .catch(error => {
                console.error(error);
            });
    });
    </script>
    <!-- Essential javascripts for application to work-->
    <?php require_once('parts/footer.php'); ?>