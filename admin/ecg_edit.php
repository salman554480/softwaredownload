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
                <h1><i class="bi bi-heart-pulse"></i> Edit ECG</h1>
                <p>Enter Details</p>

            </div>
        </div>
		<?php
				require_once('parts/db.php');
				   if(isset($_GET['edit'])){
					$edit_id = $_GET['edit'];

				
				$select_ecg = "SELECT * FROM ecg WHERE ecg_id='$edit_id'";
				$run_ecg = mysqli_query($conn,$select_ecg);
				$row_ecg = mysqli_fetch_array($run_ecg);
				
				$ecg_id =  $row_ecg['ecg_id'];
				$ecg_title =  $row_ecg['ecg_title'];
				$ecg_details =  $row_ecg['ecg_details'];
				$ecg_image =  $row_ecg['ecg_image'];
				$ecg_level =  $row_ecg['ecg_level'];
				$ecg_exp =  $row_ecg['ecg_explanation'];
				$ecg_exp_img =  $row_ecg['ecg_explanation_img'];

					
				
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
                                    <input class="form-control" value="<?php echo $ecg_title;?>" name="ecg_title" type="text" required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Details</b></label>
                                    <input class="form-control" value="<?php echo $ecg_details;?>" name="ecg_details" type="text" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Image</b></label>
                                    <input class="form-control" value="<?php echo $ecg_image;?>" name="ecg_image" type="file">
                                </div>
								
								   <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Level</b></label>
                                    <select type="text" class="form-control" name="ecg_level" value="<?php echo $ecg_level; ?>">
									 <option><?php echo $ecg_level; ?></option>
									 <option>Beginner</option>
									 <option>Technician</option> 
									 <option>Nurse</option>
									 <option>Resident</option>
									 <option>Fellow</option> 
									 <option>Physician</option>
									 <option>Specialist</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Explaination</b></label>
                                    <input class="form-control" value="<?php echo $ecg_exp;?>" name="ecg_exp" type="text" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Visual Explaination</b></label>
                                    <input class="form-control" value="<?php echo $ecg_exp_img;?>" name="ecg_exp_img" type="file">
                                </div>

                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Edit Record">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['insert_btn'])){
				
							$aecg_title = $_POST['ecg_title'];
							$aecg_details = $_POST['ecg_details'];
							$aecg_image = $_FILES['ecg_image']['name'];
							$aecg_tmp_name = $_FILES['ecg_image']['tmp_name'];
							$aecg_level = $_POST['ecg_level'];
							$aecg_exp = $_POST['ecg_exp'];
							$aecg_exp_img = $_FILES['ecg_exp_img']['name'];
							$aecg_exp_img_tmp = $_FILES['ecg_exp_img']['tmp_name'];
							
                            if($aecg_image ==  ""){
										
                                $aecg_image = $ecg_image;
                            }
                            if($aecg_exp_img ==  ""){
                                    
                                    $aecg_exp_img = $ecg_exp_img;
                                }
							
							$update_ecg = "UPDATE ecg SET ecg_title='$aecg_title',ecg_details='$aecg_details',ecg_image='$aecg_image',ecg_level='$aecg_level',ecg_explanation='$aecg_exp',ecg_explanation_img='$aecg_exp_img' WHERE ecg_id='$edit_id'";
							
							$run_ecg = mysqli_query($conn,$update_ecg);
							
							if($run_ecg == true){
								//echo "data is inserted ";
								move_uploaded_file($aecg_tmp_name,"upload/$aecg_image");
								move_uploaded_file($aecg_exp_img_tmp,"upload/$aecg_exp_img");
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('ecg_view.php','_self');</script>";
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