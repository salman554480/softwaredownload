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
                <h1><i class="bi bi-heart-pulse"></i> Add Answers ECG</h1>
                <p>Enter Details</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3 pt-4" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <?php
                                    $select_section = "SELECT * FROM section  ORDER BY section_id ASC LIMIT 5";
                                    $run_section =  mysqli_query($conn, $select_section);
                                    while ($row_section =  mysqli_fetch_array($run_section)) {

                                        $section_id =  $row_section['section_id'];
                                        $section_name =  $row_section['section_name'];
                                        
                                    ?>
                                    <h3><?php echo $section_name; ?></h3>
                                    <?php 
                                        
                                        $select_options = "SELECT * FROM sectionoption WHERE section_id='$section_id' ORDER BY sectionoption_id ASC";
                                        $run_options =  mysqli_query($conn, $select_options);
                                        while ($row_options =  mysqli_fetch_array($run_options)) {

                                            $sectionoption_id  =  $row_options['sectionoption_id'];
                                            $sectionoption_name =  $row_options['sectionoption_name'];
                                            
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $sectionoption_id; ?>" id="EcgOp<?php echo $sectionoption_id; ?>">
                                        <label class="form-check-label" for="EcgOp<?php echo $sectionoption_id; ?>"><?php echo $sectionoption_name; ?></label>
                                    </div>
                                    <?php }} ?>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    $select_section = "SELECT * FROM section  ORDER BY section_id ASC LIMIT 1 OFFSET 5";
                                    $run_section =  mysqli_query($conn, $select_section);
                                    while ($row_section =  mysqli_fetch_array($run_section)) {

                                        $section_id =  $row_section['section_id'];
                                        $section_name =  $row_section['section_name'];
                                        
                                    ?>
                                    <h3><?php echo $section_name; ?></h3>
                                    <?php 
                                        
                                        $select_options = "SELECT * FROM sectionoption WHERE section_id='$section_id' ORDER BY sectionoption_id ASC";
                                        $run_options =  mysqli_query($conn, $select_options);
                                        while ($row_options =  mysqli_fetch_array($run_options)) {

                                            $sectionoption_id  =  $row_options['sectionoption_id'];
                                            $sectionoption_name =  $row_options['sectionoption_name'];
                                            
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $sectionoption_id; ?>" id="EcgOp<?php echo $sectionoption_id; ?>">
                                        <label class="form-check-label" for="EcgOp<?php echo $sectionoption_id; ?>"><?php echo $sectionoption_name; ?></label>
                                    </div>
                                    <?php }} ?>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    $select_section = "SELECT * FROM section  ORDER BY section_id ASC LIMIT 1 OFFSET 6";
                                    $run_section =  mysqli_query($conn, $select_section);
                                    while ($row_section =  mysqli_fetch_array($run_section)) {

                                        $section_id =  $row_section['section_id'];
                                        $section_name =  $row_section['section_name'];
                                        
                                    ?>
                                    <h3><?php echo $section_name; ?></h3>
                                    <?php 
                                        
                                        $select_options = "SELECT * FROM sectionoption WHERE section_id='$section_id' ORDER BY sectionoption_id ASC";
                                        $run_options =  mysqli_query($conn, $select_options);
                                        while ($row_options =  mysqli_fetch_array($run_options)) {

                                            $sectionoption_id  =  $row_options['sectionoption_id'];
                                            $sectionoption_name =  $row_options['sectionoption_name'];
                                            
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $sectionoption_id; ?>" id="EcgOp<?php echo $sectionoption_id; ?>">
                                        <label class="form-check-label" for="EcgOp<?php echo $sectionoption_id; ?>"><?php echo $sectionoption_name; ?></label>
                                    </div>
                                    <?php }} ?>
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
							$ecg_details = $_POST['ecg_details'];
							$ecg_image = $_FILES['ecg_image']['name'];
							$ecg_tmp_name = $_FILES['ecg_image']['tmp_name'];
							$ecg_level = $_POST['ecg_level'];
							$ecg_exp = $_POST['ecg_exp'];
							$ecg_exp_img = $_FILES['ecg_exp_img']['name'];
							$ecg_exp_img_tmp = $_FILES['ecg_exp_img']['tmp_name'];
							
							
							$insert_ecg = "INSERT INTO ecg(ecg_title,ecg_details,ecg_image,ecg_level,ecg_explanation,ecg_explanation_img)VALUES('$ecg_title','$ecg_details','$ecg_image','$ecg_level','$ecg_exp','$ecg_exp_img')";
							
							$run_ecg = mysqli_query($conn,$insert_ecg);
							
							if($run_ecg == true){
								//echo "data is inserted ";
								move_uploaded_file($ecg_tmp_name,"upload/$ecg_image");
								move_uploaded_file($ecg_exp_img_tmp,"upload/$ecg_exp_img");
								echo "<script>alert('Record Added');</script>";
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