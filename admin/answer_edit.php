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

				
				$select_answer = "SELECT * FROM answer WHERE answer_id='$edit_id'";
				$run_answer = mysqli_query($conn,$select_answer);
				$row_answer = mysqli_fetch_array($run_answer);
				
				$answer_id =  $row_answer['answer_id'];
                $user_token =  $row_answer['user_token'];
                $ecg_id =  $row_answer['ecg_id'];
                $question_no =  $row_answer['question_no'];
                $user_answer =  $row_answer['user_answer'];
                $right_answer =  $row_answer['right_answer'];

					
				
				   }
			?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>User Token</b></label>
                                     <select class="form-select" name="user_token" id="example-select">
                                    <?php
									 require_once('parts/db.php');
									 
									 $select_user = "SELECT * FROM user ORDER BY user_id DESC";
									 
									 $run_user = mysqli_query($conn,$select_user);
										while( $row_user = mysqli_fetch_array ($run_user)){

										$dbuser_id = $row_user ['user_id'];
										$dbuser_token = $row_user ['user_token'];		
									  
									 ?>
									<option <?php if ($dbuser_token == $user_token) {
                                       echo "selected";
                                    } ?> value="<?php echo $dbuser_token; ?>"><?php echo $dbuser_token; ?></option>
											<?php } ?>
                                 </select>	
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>ECG</b></label>
                                    <select class="form-select" name="ecg_id" id="example-select">
                                    <?php
									 require_once('parts/db.php');
									 
									 $select_ecg = "SELECT * FROM ecg ORDER BY ecg_id DESC";
									 
									 $run_ecg = mysqli_query($conn,$select_ecg);
										while( $row_ecg = mysqli_fetch_array ($run_ecg)){

										$dbecg_id = $row_ecg ['ecg_id'];
										$dbecg_title = $row_ecg ['ecg_title'];		
									  
									 ?>
									<option <?php if ($dbecg_id == $ecg_id) {
                                       echo "selected";
                                    } ?> value="<?php echo $dbecg_id; ?>"><?php echo $dbecg_title; ?></option>
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

										$dbquestion_id = $row_question ['question_id'];
										$dbquestion_no = $row_question ['question_no'];		
									  
									 ?>
									<option <?php if ($dbquestion_id == $question_id) {
                                       echo "selected";
                                    } ?> value="<?php echo $dbquestion_id; ?>"><?php echo $dbquestion_no; ?></option>
											<?php } ?>
                                 </select>
                                </div>
								
								<div class="col-md-6 mt-3">
                                    <label class="form-label"><b>User Answer</b></label>
                                    <input type="text" class="form-control" name="user_answer" value="<?php echo $user_answer;?>">
                                </div>
                                
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Right Answer</b></label>
                                    <input type="text" class="form-control" name="right_answer" value="<?php echo $right_answer;?>">
                                </div>

                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="update_btn" type="submit" value="Save Changes">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['update_btn'])){
				
							$euser_token = $_POST['user_token'];
							$eecg_id = $_POST['ecg_id'];
							$equestion_no = $_POST['question_no'];
							$euser_answer = $_POST['user_answer'];
							$eright_answer = $_POST['right_answer'];
							
							$update_answer = "UPDATE answer SET user_token='$euser_token',ecg_id='$eecg_id',question_no='$equestion_no',user_answer='$euser_answer',right_answer='$eright_answer' WHERE answer_id='$edit_id'";
							
							$run_get_answer = mysqli_query($conn,$update_answer);
							
							if($run_get_answer == true){
								//echo "data is inserted ";
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('answer_edit.php?edit=$edit_id','_self');</script>";
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