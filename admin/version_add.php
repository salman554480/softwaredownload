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
                <h1><i class="bi bi-heart-pulse"></i> Add Version</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-4 mt-3">
                                    <label class="form-label"><b>Select Software</b></label>
                                    <select class="form-control" name="software_id" required>
                                        <option value="">Select software</option>
                                        <?php
                                        $select_software = "SELECT * FROM software";
                                        $select_software_result = mysqli_query($conn, $select_software);
                                        while ($row_software = mysqli_fetch_assoc($select_software_result)) {
                                            echo '<option value="' . $row_software['software_id'] . '">' . $row_software['software_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label"><b>Version Number</b></label>
                                    <input class="form-control" name="version_number" type="text" required>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label"><b>Release Date</b></label>
                                    <input class="form-control" name="version_release_date" type="date" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Download URL</b></label>
                                    <input class="form-control" name="version_download_url" type="text" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>File Size</b></label>
                                    <input class="form-control" name="version_file_size" type="text" required>
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
                            $software_id = $_POST['software_id'];
                            $version_number = $_POST['version_number'];
                            $version_release_date = $_POST['version_release_date'];
                            $version_download_url = $_POST['version_download_url'];
                            $version_file_size = $_POST['version_file_size'];


                            // Prepare the insert statement
                            $insert_software = "INSERT INTO version(software_id, version_number, version_release_date, version_download_url, version_file_size) 
                        VALUES('$software_id', '$version_number', '$version_release_date', '$version_download_url', '$version_file_size')";

                            // Execute the query
                            $run_software = mysqli_query($conn, $insert_software);

                            if ($run_software) {

                                $select_software = "SELECT * FROM software WHERE software_name='$software_name'";
                                $run_select_software =  mysqli_query($conn, $select_software);
                                $row_software = mysqli_fetch_array($run_select_software);
                                $software_id =  $row_software['software_id'];

                                $insert_meta = "INSERT INTO meta(meta_title,meta_description,meta_keyword,meta_source,meta_source_id) VALUES('$meta_title','$meta_description','$meta_keyword','software','$software_id')";
                                $run_insert_meta =  mysqli_query($conn, $insert_meta);

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