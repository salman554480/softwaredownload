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
				require_once('parts/db.php');
				   if(isset($_GET['sectionoption_id'])){
					$edit_id = $_GET['sectionoption_id'];

				
				$select_sectionoption = "SELECT * FROM sectionoption WHERE sectionoption_id='$edit_id'";
				$run_sectionoption = mysqli_query($conn,$select_sectionoption);
				$row_sectionoption = mysqli_fetch_array($run_sectionoption);
				
				$sectionoption_id =  $row_sectionoption['sectionoption_id'];
				$section_id =  $row_sectionoption['section_id'];
				$sectionoption_name =  $row_sectionoption['sectionoption_name'];



				$select_new_section = "SELECT * FROM section WHERE section_id ='$section_id'";
				$run_section = mysqli_query($conn,$select_new_section);
				$row_new_section = mysqli_fetch_array($run_section);
				$new_section_id = $row_new_section['section_id'];
				$new_section_name = $row_new_section['section_name'];
				
				   }
			?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Section ID</label>
                                    <select class="form-select" name="section_id" id="example-select">
                                   <?php
									 require_once('parts/db.php');
									 
									 $select_section ="SELECT * FROM section ORDER BY section_id DESC";
									 
									 $run_section = mysqli_query($conn,$select_section);
										while( $row_section = mysqli_fetch_array ($run_section)){

										$section_id = $row_section ['section_id'];
										$section_name = $row_section ['section_name'];		
									 
									 ?>
									<option value="<?php echo $section_id; ?>" <?php if($new_section_id == $section_id){echo "selected";} ?> > <?php echo $section_name; ?> </option>
											<?php } ?>
                                </select>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" value="<?php echo $sectionoption_name; ?>" name="sectionoption_name" type="text" required>
                                </div>


                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="update_btn" type="submit" value="Save Changes" required>
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['update_btn'])){
				
							$esection_id = $_POST['section_id'];
							$esectionoption_name = $_POST['sectionoption_name'];


							$update_sectionoption = "UPDATE sectionoption SET section_id='$esection_id',sectionoption_name='$esectionoption_name' WHERE sectionoption_id='$edit_id'";
							
							$run_sectionoption = mysqli_query($conn,$update_sectionoption);
							
							if($run_sectionoption == true){
								//echo "data is inserted ";
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('option_view.php','_self');</script>";
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