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
                <h1><i class="bi bi-files"></i> Add Pop Quiz</h1>
                <p>Enter Details</p>
            </div>
        </div>
    	<?php
				require_once('parts/db.php');
				   if(isset($_GET['ecg_id'])){
					$ecg_id = $_GET['ecg_id'];
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
                                    <input class="form-control" name="popquiz_title" type="text"  required>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Instructions</b></label>
                                    <input class="form-control" name="popquiz_instructions" type="text" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 1</b></label>
                                    <input class="form-control" name="popquiz_option1" type="file" >
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 2</b></label>
                                    <input class="form-control" name="popquiz_option2" type="file" >
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 3</b></label>
                                    <input class="form-control" name="popquiz_option3" type="file" >
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Option 4</b></label>
                                    <input class="form-control" name="popquiz_option4" type="file" >
                                </div>
                                
                                 <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Answer</b></label>
                                    <input class="form-control" name="popquiz_answer" type="text" >
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
				
							$popquiz_title = $_POST['popquiz_title'];
							$popquiz_instructions = $_POST['popquiz_instructions'];
							$popquiz_answer = $_POST['popquiz_answer'];
							
							$popquiz_option1 = $_FILES['popquiz_option1']['name'];
							$popquiz_option1_tmp = $_FILES['popquiz_option1']['tmp_name'];
							
							$popquiz_option2 = $_FILES['popquiz_option2']['name'];
							$popquiz_option2_tmp = $_FILES['popquiz_option2']['tmp_name'];
							
							$popquiz_option3 = $_FILES['popquiz_option3']['name'];
							$popquiz_option3_tmp = $_FILES['popquiz_option3']['tmp_name'];
							
							$popquiz_option4 = $_FILES['popquiz_option4']['name'];
							$popquiz_option4_tmp = $_FILES['popquiz_option4']['tmp_name'];
							
							
							$insert_popquiz = "INSERT INTO popquiz(ecg_id,popquiz_title,popquiz_instructions,popquiz_option1,popquiz_option2,popquiz_option3,popquiz_option4,popquiz_answer)VALUES('$ecg_id','$popquiz_title','$popquiz_instructions','$popquiz_option1','$popquiz_option2','$popquiz_option3','$popquiz_option4','$popquiz_answer')";
							
							$run_popquiz = mysqli_query($conn,$insert_popquiz);
							
							if($run_popquiz == true){
								//echo "data is inserted ";
								move_uploaded_file($popquiz_option1_tmp,"upload/$popquiz_option1");
								move_uploaded_file($popquiz_option2_tmp,"upload/$popquiz_option2");
								move_uploaded_file($popquiz_option3_tmp,"upload/$popquiz_option3");
								move_uploaded_file($popquiz_option4_tmp,"upload/$popquiz_option4");
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