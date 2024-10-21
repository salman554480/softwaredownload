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
                <h1><i class="bi bi-file-pdf"></i><b> Edit Document</b></h1>
                <p>Enter Details</p>

            </div>
        </div>
		<?php
				require_once('parts/db.php');
				   if(isset($_GET['edit'])){
					$edit_id = $_GET['edit'];

				
				$select_document = "SELECT * FROM document WHERE document_id='$edit_id'";
				$run_document = mysqli_query($conn,$select_document);
				$row_document = mysqli_fetch_array($run_document);
				
				$document_id =  $row_document['document_id'];
				$section_id =  $row_document['section_id'];
				$document =  $row_document['document'];

					
				
				   }
			?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Section</label>
                                     <select class="form-select" name="section_id" id="example-select">
                                    <?php
									 require_once('parts/db.php');
									 
									 $select_section = "SELECT * FROM section ORDER BY section_id DESC";
									 
									 $run_section = mysqli_query($conn,$select_section);
										while( $row_section = mysqli_fetch_array ($run_section)){

										$dbsection_id = $row_section ['section_id'];
										$dbsection_name = $row_section ['section_name'];		
									  
									 ?>
									<option <?php if ($dbsection_id == $section_id) {
                                       echo "selected";
                                    } ?> value="<?php echo $dbsection_id; ?>"><?php echo $dbsection_name; ?></option>
											<?php } ?>
                                 </select>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Document</label>
                                    <input class="form-control" value="<?php echo $document;?>" name="document" type="file">
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
				
							$asection_id = $_POST['section_id'];
							$adocument = $_FILES['document']['name'];
							$adocument_tmp_name = $_FILES['document']['tmp_name'];

								if($adocument ==  ""){
										
										$adocument = $document;
									}
							
							$update_document = "UPDATE document SET section_id='$asection_id',document='$adocument' WHERE document_id='$edit_id'";
							
							$run_document = mysqli_query($conn,$update_document);
							
							if($run_document == true){
								//echo "data is inserted ";
								move_uploaded_file($adocument_tmp_name,"upload/$adocument");
								echo "<script>alert('Record update');</script>";
								echo "<script>window.open('document_view.php','_self');</script>";
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