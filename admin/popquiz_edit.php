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
                <h1><i class="bi bi-speedometer"></i> Edit New Course</h1>
                <p>Enter Details</p>

            </div>
        </div>
		<?php
				require_once('parts/db.php');
				   if(isset($_GET['edit'])){
					$edit_id = $_GET['edit'];

				
				$select_popquiz = "SELECT * FROM popquiz WHERE popquiz_id='$edit_id'";
				$run_popquiz = mysqli_query($conn,$select_popquiz);
				$row_popquiz = mysqli_fetch_array($run_popquiz);
				
		        $popquiz_id =  $row_popquiz['popquiz_id'];
                $popquiz_title =  $row_popquiz['popquiz_title'];
                $popquiz_instructions =  $row_popquiz['popquiz_instructions'];
                $popquiz_option1 =  $row_popquiz['popquiz_option1'];
                $popquiz_option2 =  $row_popquiz['popquiz_option2'];
                $popquiz_option3 =  $row_popquiz['popquiz_option3'];
                $popquiz_option4 =  $row_popquiz['popquiz_option4'];
                $popquiz_answer =  $row_popquiz['popquiz_answer'];

					
				
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
                                    <input class="form-control" name="popquiz_title" type="text" value="<?php echo $popquiz_title?>"  required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Instructions</b></label>
                                    <input class="form-control" name="popquiz_instructions" type="text" value="<?php echo $popquiz_instructions?>"  required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 1</b></label>
                                    <input class="form-control" name="popquiz_option1" type="file">
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 2</b></label>
                                    <input class="form-control" name="popquiz_option2" type="file">
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 3</b></label>
                                    <input class="form-control" name="popquiz_option3" type="file">
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 4</b></label>
                                    <input class="form-control" name="popquiz_option4" type="file">
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Answer</b></label>
                                    <input class="form-control" name="popquiz_answer" type="text" value="<?php echo $popquiz_answer?>" required>
                                </div>
								
								

                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Save Changes">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['insert_btn'])){
				
						$epopquiz_title = $_POST['popquiz_title'];
						$epopquiz_instructions = $_POST['popquiz_instructions'];
						$epopquiz_answer = $_POST['popquiz_answer'];
						
						$epopquiz_option1 = $_FILES['popquiz_option1']['name'];
						$epopquiz_option1_tmp = $_FILES['popquiz_option1']['tmp_name'];
						
						$epopquiz_option2 = $_FILES['popquiz_option2']['name'];
						$epopquiz_option2_tmp = $_FILES['popquiz_option2']['tmp_name'];
						
						$epopquiz_option3 = $_FILES['popquiz_option3']['name'];
						$epopquiz_option3_tmp = $_FILES['popquiz_option3']['tmp_name'];
						
						$epopquiz_option4 = $_FILES['popquiz_option4']['name'];
						$epopquiz_option4_tmp = $_FILES['popquiz_option4']['tmp_name'];
						
						if($epopquiz_option1 ==  ""){
										
                            $epopquiz_option1 = $popquiz_option1;
                        }
                        
                        if($epopquiz_option2 ==  ""){
										
                            $epopquiz_option2 = $popquiz_option2;
                        }
                        
                        if($epopquiz_option3 ==  ""){
										
                            $epopquiz_option3 = $popquiz_option3;
                        }
                        
                        if($epopquiz_option4 ==  ""){
										
                            $epopquiz_option4 = $popquiz_option4;
                        }
    			
					
							
    					$update_popquiz = "UPDATE popquiz SET popquiz_title='$epopquiz_title',popquiz_instructions='$epopquiz_instructions',popquiz_option1='$epopquiz_option1',popquiz_option2='$epopquiz_option2',popquiz_option3='$epopquiz_option3',popquiz_option4='$epopquiz_option4',popquiz_answer='$epopquiz_answer' WHERE popquiz_id='$edit_id'";
    					
    					$run_popquiz = mysqli_query($conn,$update_popquiz);
    					
    					if($run_popquiz == true){
    						//echo "data is inserted ";
    						move_uploaded_file($epopquiz_option1_tmp,"upload/$epopquiz_option1");
    						move_uploaded_file($epopquiz_option2_tmp,"upload/$epopquiz_option2");
    						move_uploaded_file($epopquiz_option3_tmp,"upload/$epopquiz_option3");
    						move_uploaded_file($epopquiz_option4_tmp,"upload/$epopquiz_option4");
    						echo "<script>alert('Record update');</script>";
    						echo "<script>window.open('popquiz_view.php','_self');</script>";
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