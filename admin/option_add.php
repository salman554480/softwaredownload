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
                <h1><i class="bi bi-ui-checks"></i> Add Options</h1>
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
                                   <select type="text" class="form-control" name="section_id">
                                    <?php
                                        require_once('parts/db.php');

                                        $select_section = "SELECT * FROM section ORDER BY section_id DESC";

                                        $run_section = mysqli_query($conn, $select_section);
                                        while ($row_section = mysqli_fetch_array($run_section)) {

                                            $section_id = $row_section['section_id'];
                                            $section_name = $row_section['section_name'];

                                        ?>
                                            <option value="<?php echo $section_id; ?>"><?php echo $section_name; ?></option>
                                        <?php } ?>
                           
                                   </select>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Name</b></label>
                                    <input class="form-control" name="sectionoption_name" type="text" required>
                                </div>
                            

                            <div class="mb-3 row mt-3">
                                <div class="col-md-12">
                                    <input class="btn btn-success" name="insert_btn" type="submit" value="Add Record">
                                </div>
                            </div>
                        </form>
						
						<?php
						require_once('parts/db.php');
						if(isset($_POST['insert_btn'])){
				
							$section_id = $_POST['section_id'];
							$sectionoption_name = $_POST['sectionoption_name'];
						
							
							
							$insert_sectionoption = "INSERT INTO sectionoption(section_id,sectionoption_name)VALUES('$section_id','$sectionoption_name')";
							
							$run_sectionoption = mysqli_query($conn,$insert_sectionoption);
							
							if($run_sectionoption == true){
								//echo "data is inserted ";
								echo "<script>alert('Record Added');</script>";
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