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
                <h1><i class="bi bi-people"></i> Users Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Users Record</a></li>
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

						$delete = "DELETE FROM user WHERE user_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('user_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Image</th>
                                        <th>Level</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_user = "SELECT * FROM user ORDER BY user_id DESC";
                                    $run_user =  mysqli_query($conn, $select_user);
                                    while ($row_user =  mysqli_fetch_array($run_user)) {

                                        $user_id =  $row_user['user_id'];
                                        $user_name =  $row_user['user_name'];
                                        $user_email =  $row_user['user_email'];
                                        $user_password =  $row_user['user_password'];
                                        $user_image =  $row_user['user_image'];
                                        $user_level =  $row_user['user_level'];
                                        

                                    ?>
                                        <tr>
                                            <td><?php echo $user_id; ?></td>
                                            <td><a href="user_details.php?user_id=<?php echo $user_id;?>" class="text-body fw-semibold"><?php echo $user_name; ?></a></td>
                                            <td><?php echo $user_email; ?></td>
                                            <td><?php echo $user_password; ?></td>
                                            <td><img height="50px" src="upload/<?php echo $user_image; ?>"></td>
                                            <td><?php echo $user_level; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="user_view.php?del=<?php echo $user_id; ?>">Delete</a></li>
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