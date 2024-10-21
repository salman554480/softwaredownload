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
                <h1><i class="bi bi-ui-checks"></i> Edit Options</h1>
                <p>Enter Details</p>

            </div>
        </div>
	<?php
      if(isset($_GET['edit'])){
          $edit_id = $_GET['edit'];
      
      
      $select_option = "SELECT * FROM option WHERE option_id='$edit_id'";
      $run_option = mysqli_query($conn,$select_option);
      $row_option = mysqli_fetch_array($run_option);
      
      $option_id =  $row_option['option_id'];
      $option_title =  $row_option['option_title'];
      $option_status =  $row_option['option_status'];
     
      }
      ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="option_title" class="form-control" value="<?php echo $option_title;?>">
                                </select>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="option_status" >
                                        <option><?php echo $option_status;?></option>
                                        <option>disabled</option>
                                        <option>active</option>
                                    </select>    
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="update_btn" type="submit" value="Edit Record">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['update_btn'])){
				
							$eoption_title = $_POST['option_title'];
							$eoption_status = $_POST['option_status'];


							$update_option = "UPDATE option SET option_title='$eoption_title',option_status='$eoption_status' WHERE option_id='$edit_id'";
							
							$run_option = mysqli_query($conn,$update_option);
							
							if($run_option == true){
								//echo "data is inserted ";
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('question_option_edit.php?edit=$option_id','_self');</script>";
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