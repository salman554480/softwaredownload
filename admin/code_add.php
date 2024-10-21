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
                <h1><i class="bi bi-heart-pulse"></i> Add Right Codes</h1>
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
                                    <label class="form-label"><b>Select ECG</b></label>
                                    <select class="form-control" name="ecg_id" >
                                        <?php 
                                        $select_ecg = "SELECT * FROM ecg";
                                        $run_select_ecg =  mysqli_query($conn,$select_ecg);
                                        while($row_select_ecg = mysqli_fetch_array($run_select_ecg)){
                                                $ecg_id =  $row_select_ecg['ecg_id'];
                                                $ecg_title =  $row_select_ecg['ecg_title'];
                                        ?>
                                        <option value="<?php echo $ecg_id;?>"><?php echo $ecg_title;?></option>
                                        <?php } ?>
                                    </select>    
                                </div>
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Right Options</b></label>
                                    <select class="form-control" name="sectionoption_id" >
                                        <?php 
                                        $select_option = "SELECT * FROM sectionoption";
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
				
							$ecg_id = $_POST['ecg_id'];
							$sectionoption_id = $_POST['sectionoption_id'];
							
							
					echo		$insert_answer = "INSERT INTO sectionanswers(ecg_id,sectionoption_id)VALUES('$ecg_id','$sectionoption_id')";
							
							$run_answer = mysqli_query($conn,$insert_answer);
							
							if($run_answer == true){
								//echo "data is inserted ";
								echo "<script>window.open('code_add.php','_self');</script>";
								
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