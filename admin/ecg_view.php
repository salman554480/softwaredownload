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
                <h1><i class="bi bi-heart-pulse"></i> ECG Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">ECG Record</a></li>
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

						$delete = "DELETE FROM ecg WHERE ecg_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('ecg_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Image</th>
                                        <th>Level</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_ecg = "SELECT * FROM ecg ORDER BY ecg_id DESC";
                                    $run_ecg =  mysqli_query($conn, $select_ecg);
                                    while ($row_ecg =  mysqli_fetch_array($run_ecg)) {

                                        $ecg_id =  $row_ecg['ecg_id'];
                                        $ecg_title =  $row_ecg['ecg_title'];
                                        $ecg_details =  $row_ecg['ecg_details'];
                                        $ecg_image =  $row_ecg['ecg_image'];
                                        $ecg_level =  $row_ecg['ecg_level'];
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo $ecg_id; ?></td>
                                            <td><?php echo $ecg_title; ?></td>
                                            <td><?php echo $ecg_details; ?></td>
                                            <td><img height="50px" src="upload/<?php echo $ecg_image; ?>"></td>
                                            <td><?php echo $ecg_level; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="ecg_view.php?del=<?php echo $ecg_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="ecg_edit.php?edit=<?php echo $ecg_id; ?>">Edit</a>
                                                        <li><a class="dropdown-item" href="ecg_data.php?ecg_id=<?php echo $ecg_id; ?>">ECG Record</a>
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