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
                <h1><i class="bi bi-speedometer"></i><b> ECG Attempt Record</b></h1>
                
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

						$delete = "DELETE FROM ecgattempt WHERE ecgattempt_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('ecgattempt_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ECG</th>
                                        <th>Question No</th>
                                        <th>User Token</th>
                                        <th>Status</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_ecgattempt = "SELECT * FROM ecgattempt ORDER BY ecgattempt_id DESC";
                                    $run_ecgattempt =  mysqli_query($conn, $select_ecgattempt);
                                    while ($row_ecgattempt =  mysqli_fetch_array($run_ecgattempt)) {

                                        $ecgattempt_id =  $row_ecgattempt['ecgattempt_id'];
                                        $user_token =  $row_ecgattempt['user_token'];
                                        $ecg_id =  $row_ecgattempt['ecg_id'];
                                        $question_no =  $row_ecgattempt['question_no'];
                                        $ecgattempt_status =  $row_ecgattempt['ecgattempt_status'];

                                        
                                        $select_ecg = "SELECT * FROM ecg WHERE ecg_id='$ecg_id'";
											 
									    $run_ecg = mysqli_query($conn,$select_ecg);
										$row_ecg = mysqli_fetch_array ($run_ecg);

										$ecg_id = $row_ecg['ecg_id'];
										$ecg_title = $row_ecg['ecg_title'];
										
										
										$select_question = "SELECT * FROM question WHERE question_id='$question_no'";
											 
									    $run_question = mysqli_query($conn,$select_question);
										$row_question = mysqli_fetch_array ($run_question);

										$question_id = $row_question ['question_id'];
										$question_title = $row_question ['question_title'];
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo $ecgattempt_id; ?></td>
                                            <td><?php echo $ecg_title; ?></td>
                                            <td><?php echo $question_title; ?></td>
                                            <td><?php echo $user_token; ?></td>
                                            <td><?php echo $ecgattempt_status; ?></td>

											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="ecgattempt_view.php?del=<?php echo $ecgattempt_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="ecgattempt_edit.php?edit=<?php echo $ecgattempt_id; ?>">Edit</a>
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