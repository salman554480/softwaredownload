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
                                    <textarea class="form-control" name="ecg_exp"  required></textarea>
                                </div>
                            
                            <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Image</b></label>
                                    <input class="form-control" name="ecg_image" type="file" >
                                </div>
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Visual Explaination</b></label>
                                    <input class="form-control" name="ecg_exp_img" type="file" >
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Right Options</b></label>
                                    <select class="form-control" style="height:300px" name="sectionoption_id[]" multiple >
                                        <?php 
                                        $select_option = "SELECT * FROM sectionoption ORDER BY sectionoption_name ASC";
                                        $run_select_option =  mysqli_query($conn,$select_option);
                                        while($row_select_option = mysqli_fetch_array($run_select_option)){
                                            $sectionoption_id =  $row_select_option['sectionoption_id'];
                                            $sectionoption_name =  $row_select_option['sectionoption_name'];
                                        ?>
                                        <option value="<?php echo $sectionoption_id;?>"><?php echo $sectionoption_name;?></option>
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>    

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Add Record">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['insert_btn'])){
				
							$ecg_title = $_POST['ecg_title'];
							$ecg_image = $_FILES['ecg_image']['name'];
							$ecg_tmp_name = $_FILES['ecg_image']['tmp_name'];
							$ecg_level = $_POST['ecg_level'];
							$ecg_exp = str_replace("'", "\'", $_POST['ecg_exp']);
							$ecg_exp_img = $_FILES['ecg_exp_img']['name'];
							$ecg_exp_img_tmp = $_FILES['ecg_exp_img']['tmp_name'];
							
							
							$insert_ecg = "INSERT INTO ecg(ecg_title,ecg_image,ecg_level,ecg_explanation,ecg_explanation_img)VALUES('$ecg_title','$ecg_image','$ecg_level','$ecg_exp','$ecg_exp_img')";
							
							$run_ecg = mysqli_query($conn,$insert_ecg);
							
							if($run_ecg == true){
								//echo "data is inserted ";
								move_uploaded_file($ecg_tmp_name,"upload/$ecg_image");
								move_uploaded_file($ecg_exp_img_tmp,"upload/$ecg_exp_img");
								
								// select latest ecg
								$select_last_ecg = "SELECT * FROM ecg order by ecg_id DESC";
                                $run_select_ecg =  mysqli_query($conn,$select_last_ecg);
                                $row_select_ecg = mysqli_fetch_array($run_select_ecg);
                                $ecg_id =  $row_select_ecg['ecg_id'];
                                
                                // Check if sectionoption_id is submitted and not empty
                                    if(isset($_POST['sectionoption_id']) && !empty($_POST['sectionoption_id'])) {
                                        
                                        // Loop through each selected option
                                        foreach($_POST['sectionoption_id'] as $selected) {
                                            // Insert each selected option into sectionanswers table
                                            $insert_query = "INSERT INTO sectionanswers (ecg_id, sectionoption_id) VALUES ('$ecg_id', '$selected')";
                                            mysqli_query($conn, $insert_query);
                                        }
                                
                                        // Insertion completed
                                        echo "Records inserted successfully.";
                                    } else {
                                        // No options selected
                                        echo "Please select at least one option.";
                                    }
								
								
								
								
								echo "<script>alert('Record Added');</script>";
								echo "<script>window.open('ecg_data.php?ecg_id=$ecg_id','_self');</script>";
								
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