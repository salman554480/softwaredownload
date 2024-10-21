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
                <h1><i class="bi bi-ui-checks"></i> Section Option Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Section Option Record</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
						
						<?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "DELETE FROM sectionoption WHERE sectionoption_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('option_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>Section</th>
                                        <th>Name</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_sectionoption = "SELECT * FROM sectionoption ORDER BY sectionoption_name ASC";
                                    $run_sectionoption =  mysqli_query($conn, $select_sectionoption);
                                    while ($row_sectionoption =  mysqli_fetch_array($run_sectionoption)) {

                                        $sectionoption_id =  $row_sectionoption['sectionoption_id'];
                                        $section_id =  $row_sectionoption['section_id'];
                                        $sectionoption_name =  $row_sectionoption['sectionoption_name'];

                                     $select_section ="SELECT * FROM section WHERE section_id='$section_id'";
													 
									 $run_section = mysqli_query($conn,$select_section);
									 $row_section = mysqli_fetch_array ($run_section);

										$section_id = $row_section ['section_id'];
										$section_name = $row_section ['section_name'];	
                                    ?>
                                        <tr>
                                            <td><?php echo $section_name; ?></td>
                                            <td><?php echo $sectionoption_name; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="option_view.php?del=<?php echo $sectionoption_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="option_edit.php?sectionoption_id=<?php echo $sectionoption_id; ?>">Edit</a>
                                                        </li>
                                                      
                                                    </ul>
                                                </div>
                                            </td>
									   </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <?php require_once('parts/footer.php'); ?>