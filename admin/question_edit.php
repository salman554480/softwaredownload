<?php require_once('parts/top.php'); ?>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <?php require_once('parts/sidebar.php'); ?>
      <?php
      if(isset($_GET['edit'])){
          $edit_id = $_GET['edit'];
      
      
      $select_question = "SELECT * FROM question WHERE question_id='$edit_id'";
      $run_question = mysqli_query($conn,$select_question);
      $row_question = mysqli_fetch_array($run_question);
      
      $ecg_id =  $row_question['ecg_id'];
      $question_id =  $row_question['question_id'];
      $ecg_level =  $row_question['ecg_level'];
      $question_title =  $row_question['question_title'];
      $question_right_answer =  $row_question['question_right_answer'];

      }
      ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-speedometer"></i> Edit Record</h1>
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
                                    <label class="form-label"><b>Choose Level</b></label>
                                    <select type="text" class="form-control" name="ecg_level">
									 <option><?php echo $ecg_level;?></option>
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
                                    <label class="form-label"><b>Title</b></label>
                                    <input class="form-control" name="question_title" type="text" value="<?php echo $question_title;?>">
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Right Answer</b></label>
                                    <input class="form-control" name="question_right_answer" type="text" value="<?php echo $question_right_answer;?>">
                                </div>
								
                            </div>

											   
							<div class="mb-3 row mt-3">
								<div class="col-md-12">
									<input class="btn btn-success" name="update_btn" type="submit" value="Save Changes">
								</div>
							</div>
                        </form>

                          <?php
                             require_once('parts/db.php');
                             if(isset($_POST['update_btn'])){
                             
                             	$aecg_level = $_POST['ecg_level'];
                             	$aquestion_title = $_POST['question_title'];
                             	$aquestion_right_answer = $_POST['question_right_answer'];

                             	$aquestion_title = str_replace("'", "\'", $aquestion_title);
                             	
                             	$aquestion_right_answer = str_replace("'", "\'", $aquestion_right_answer);
                             	
                             	
                             	$update_question = "UPDATE question SET ecg_level='$aecg_level',question_title='$aquestion_title',question_right_answer='$aquestion_right_answer' WHERE question_id='$edit_id'";
                             	
                             	$run_question = mysqli_query($conn,$update_question);
                             	
                             	if($run_question == true){
                             		//echo "data is inserted ";
                             		echo "<script>alert('Question Update');</script>";
                             		echo "<script>window.open('question_edit.php?edit=$question_id','_self');</script>";
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
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <?php require_once('parts/footer.php'); ?>