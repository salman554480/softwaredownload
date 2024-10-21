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
                <h1><i class="bi bi-speedometer"></i> Add New Record</h1>
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
                                    <label class="form-label"><b>ECG</b></label>
                                    <select class="form-select" name="ecg_id" id="example-select">
                                    <?php
									 require_once('parts/db.php');
									 
									 $select_ecg = "SELECT * FROM ecg ORDER BY ecg_id DESC";
									 
									 $run_ecg = mysqli_query($conn,$select_ecg);
										while( $row_ecg = mysqli_fetch_array ($run_ecg)){

										$ecg_id = $row_ecg ['ecg_id'];
										$ecg_title = $row_ecg ['ecg_title'];		
									  
									 ?>
									<option value="<?php echo $ecg_id;?>"><?php echo $ecg_title;?></option>
											<?php } ?>
                                 </select>
                                </div>
                                
                                
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Question</b></label>
                                     <select class="form-select" name="question_no" id="example-select">
                                    <?php
									 require_once('parts/db.php');
									 
									 $select_question = "SELECT * FROM question ORDER BY question_id DESC";
									 
									 $run_question = mysqli_query($conn,$select_question);
										while( $row_question = mysqli_fetch_array ($run_question)){

										$question_id = $row_question ['question_id'];
										$question_no = $row_question ['question_no'];		
									  
									 ?>
									<option value="<?php echo $question_id;?>"><?php echo $question_no;?></option>
											<?php } ?>
                                 </select>
                                </div>
                                
                                
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>User Token</b></label>
                                     <select class="form-select" name="user_token" id="example-select">
                                    <?php
									 require_once('parts/db.php');
									 
									 $select_user = "SELECT * FROM user ORDER BY user_id DESC";
									 
									 $run_user = mysqli_query($conn,$select_user);
										while( $row_user = mysqli_fetch_array ($run_user)){

										$user_id = $row_user ['user_id'];
										$user_token = $row_user ['user_token'];		
									  
									 ?>
									<option value="<?php echo $user_token;?>"><?php echo $user_token;?></option>
											<?php } ?>
                                 </select>	
                                </div>
                                
                                
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Status</b></label>
                                    <select name="ecgattempt_status" class="form-select">
                                        <option>pending</option>
                                        <option>inprocess</option>
                                        <option>complete</option>
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
							$question_no = $_POST['question_no'];
							$user_token = $_POST['user_token'];
							$ecgattempt_status = $_POST['ecgattempt_status'];

							
							$insert_ecgattempt = "INSERT INTO ecgattempt(ecg_id,question_no,user_token,ecgattempt_status)VALUES('$ecg_id','$question_no','$user_token','$ecgattempt_status')";
							
							$run_get_ecgattempt = mysqli_query($conn,$insert_ecgattempt);
							
							if($run_get_ecgattempt == true){
								//echo "data is inserted ";
								echo "<script>alert('Record Added');</script>";
								echo "<script>window.open('ecgattempt_view.php','_self');</script>";
								
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