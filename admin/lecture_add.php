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
                <h1><i class="bi bi-person-video3"></i> Add Lecture</h1>
                <p>Enter Details</p>

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
                                    <input class="form-control" name="lecture_title" type="text" required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Media</b></label>
                                    <input class="form-control" name="lecture_media" type="file" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Tumbnail</b></label>
                                    <input class="form-control" name="lecture_img" type="file" required>
                                </div>
								

                            <div class="mt-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Add Record">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['insert_btn'])){
				
							$lecture_title = $_POST['lecture_title'];
							$lecture_media = $_FILES['lecture_media']['name'];
							$lecture_media_tmp = $_FILES['lecture_media']['tmp_name'];
							$lecture_img = $_FILES['lecture_img']['name'];
							$lecture_img_tmp = $_FILES['lecture_img']['tmp_name'];
                            $lecture_date = date("d-m-Y");
							
            
							
							$insert_lecture = "INSERT INTO lectures(lecture_title,lecture_media,lecture_img,lecture_date)VALUES('$lecture_title','$lecture_media','$lecture_img','$lecture_date')";
							
							$run_lecture = mysqli_query($conn,$insert_lecture);
							
							if($run_lecture == true){
								echo "data is inserted ";
								move_uploaded_file($lecture_media_tmp,"upload/$lecture_media");
								move_uploaded_file($lecture_img_tmp,"upload/$lecture_img");
								echo "<script>alert('Record Added');</script>";
								echo "<script>window.open('lecture_view.php','_self');</script>";
								
							}else{
								echo "fail";
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