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
                <h1><i class="bi bi-camera-reels"></i> Edit Reel</h1>
                <p>Enter Details</p>

            </div>
        </div>
		<?php
				require_once('parts/db.php');
				   if(isset($_GET['edit'])){
					$edit_id = $_GET['edit'];

				
				$select_reel = "SELECT * FROM reels WHERE reel_id='$edit_id'";
			    $run_reel =  mysqli_query($conn, $select_reel);
                $row_reel =  mysqli_fetch_array($run_reel);

                    $reel_id =  $row_reel['reel_id'];
                    $reel_title =  $row_reel['reel_title'];
                    $reel_des =  $row_reel['reel_des'];
                    $reel_date =  $row_reel['reel_date'];
                    $reel_likes =  $row_reel['reel_likes'];
                    $reel_media =  $row_reel['reel_media'];

					
				
				   }
			?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Title</b></label>
                                    <input class="form-control" name="reel_title" value="<?php echo $reel_title;?>" type="text" required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Description</b></label>
                                    <input class="form-control" name="reel_des" value="<?php echo $reel_des;?>" type="text" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Media</b></label>
                                    <input class="form-control" name="reel_media" value="<?php echo $reel_media;?>" type="file">
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
				
							$ereel_title = $_POST['reel_title'];
							$ereel_des = $_POST['reel_des'];
							$ereel_media = $_FILES['reel_media']['name'];
							$ereel_media_tmp = $_FILES['reel_media']['tmp_name'];
                            $ereel_date = date("d-m-Y");
							
                            if($ereel_media ==  ""){
										
                                $ereel_media = $reel_media;
                            }

							$update_reel = "UPDATE reels SET reel_title='$ereel_title',reel_des='$ereel_des',reel_media='$ereel_media' WHERE reel_id='$edit_id'";
							
							$erun_reel = mysqli_query($conn,$update_reel);
							
							if($erun_reel == true){
								//echo "data is inserted ";
								move_uploaded_file($ereel_media_tmp,"upload/$ereel_media");
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('reel_view.php','_self');</script>";
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