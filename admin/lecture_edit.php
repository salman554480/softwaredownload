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
                <h1><i class="bi bi-person-video3"></i> Edit Lecture</h1>
                <p>Enter Details</p>

            </div>
        </div>
		<?php
				require_once('parts/db.php');
				   if(isset($_GET['edit'])){
					$edit_id = $_GET['edit'];

				
				$select_lecture = "SELECT * FROM lectures WHERE lecture_id='$edit_id'";
			    $run_lecture =  mysqli_query($conn, $select_lecture);
                $row_lecture =  mysqli_fetch_array($run_lecture);

                    $lecture_id =  $row_lecture['lecture_id'];
                    $lecture_title =  $row_lecture['lecture_title'];
                    $lecture_media =  $row_lecture['lecture_media'];
                    $lecture_img =  $row_lecture['lecture_img'];
                    $lecture_date =  $row_lecture['lecture_date'];

					
				
				   }
			?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Title</b></label>
                                    <input class="form-control" name="lecture_title" value="<?php echo $lecture_title;?>" type="text" required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Media</b></label>
                                    <input class="form-control" name="lecture_media" value="<?php echo $lecture_media;?>" type="file">
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Tumbnail</b></label>
                                    <input class="form-control" name="lecture_img" value="<?php echo $lecture_img;?>" type="file">
                                </div>
								

                            <div class="mt-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Save Changes">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['insert_btn'])){
				
							$electure_title = $_POST['lecture_title'];
							$electure_media = $_FILES['lecture_media']['name'];
							$electure_media_tmp = $_FILES['lecture_media']['tmp_name'];
							$electure_img = $_FILES['lecture_img']['name'];
							$electure_img_tmp = $_FILES['lecture_img']['tmp_name'];
                            $electure_date = date("d-m-Y");
							
                            if($electure_media ==  ""){
										
                                $electure_media = $lecture_media;
                            }
                            if($electure_img ==  ""){
										
                                $electure_img = $lecture_img;
                            }

							$update_lecture = "UPDATE lectures SET lecture_title='$electure_title',lecture_media='$electure_media',lecture_img='$electure_img' WHERE lecture_id='$edit_id'";
							
							$erun_lecture = mysqli_query($conn,$update_lecture);
							
							if($erun_lecture == true){
								//echo "data is inserted ";
								move_uploaded_file($electure_media_tmp,"upload/$electure_media");
								move_uploaded_file($electure_img_tmp,"upload/$electure_img");
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('lecture_view.php','_self');</script>";
							}else{
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