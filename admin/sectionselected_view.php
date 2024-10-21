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
                <h1><i class="bi bi-speedometer"></i><b> Section Selected Record</b></h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
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

						$delete = "DELETE FROM sectionselected WHERE sectionselected_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('sectionselected_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>ECG</th>
                                        <th>Section Option</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_sectionselected = "SELECT * FROM sectionselected ORDER BY sectionselected_id DESC";
                                    $run_sectionselected =  mysqli_query($conn, $select_sectionselected);
                                    while ($row_sectionselected =  mysqli_fetch_array($run_sectionselected)) {

                                        $sectionselected_id =  $row_sectionselected['sectionselected_id'];
                                        $user_token =  $row_sectionselected['user_token'];
                                        $ecg_id =  $row_sectionselected['ecg_id'];
                                        $sectionoption_id = $row_sectionselected['sectionoption_id'];
                                        
                                        $select_ecg = "SELECT * FROM ecg WHERE ecg_id='$ecg_id'";

											$run_ecg = mysqli_query($conn, $select_ecg);
											$row_ecg = mysqli_fetch_array($run_ecg);

											$ecg_id = $row_ecg['ecg_id'];
											$ecg_title = $row_ecg['ecg_title'];
											
											
											
										$select_sectionoption = "SELECT * FROM sectionoption WHERE sectionoption_id='$sectionoption_id'";

											$run_sectionoption = mysqli_query($conn, $select_sectionoption);
											$row_sectionoption = mysqli_fetch_array($run_sectionoption);

											$sectionoption_id = $row_sectionoption['sectionoption_id'];
											$sectionoption_name = $row_sectionoption['sectionoption_name'];
										
										
										 $select_user ="SELECT * FROM user WHERE user_token='$user_token'";
													 
										 $run_user = mysqli_query($conn,$select_user);
										 $row_user = mysqli_fetch_array ($run_user);

											$user_id = $row_user ['user_id'];
											$user_name = $row_user ['user_name'];		


                                    ?>
                                        <tr>
                                            <td><?php echo $sectionselected_id; ?></td>
                                            <td><?php echo $user_name; ?></td>
                                            <td><?php echo $ecg_title; ?></td>
                                            <td><?php echo $sectionoption_name; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="sectionselected_view.php?del=<?php echo $sectionselected_id; ?>">Delete</a></li>
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