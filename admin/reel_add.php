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
                <h1><i class="bi bi-camera-reels"></i> Add Reel</h1>
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
                                    <input class="form-control" name="reel_title" type="text" required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Description</b></label>
                                    <input class="form-control" name="reel_des" type="text" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Media</b></label>
                                    <input class="form-control" name="reel_media" type="file" required>
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
				
							$reel_title = $_POST['reel_title'];
							$reel_des = $_POST['reel_des'];
							$reel_media = $_FILES['reel_media']['name'];
							$reel_media_tmp = $_FILES['reel_media']['tmp_name'];
                            $reel_date = date("d-m-Y");
							
            
							
							$insert_reel = "INSERT INTO reels(reel_title,reel_des,reel_date,reel_likes,reel_media)VALUES('$reel_title','$reel_des','$reel_date','0','$reel_media')";
							
							$run_reel = mysqli_query($conn,$insert_reel);
							
							if($run_reel == true){
								echo "data is inserted ";
								move_uploaded_file($reel_media_tmp,"upload/$reel_media");
								echo "<script>alert('Record Added');</script>";
								echo "<script>window.open('reel_view.php','_self');</script>";
								
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