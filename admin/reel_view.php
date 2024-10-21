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
                <h1><i class="bi bi-camera-reels"></i> Reel Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Reel Record</a></li>
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
                            $reel_id = $_GET['del'];

						$delete = "DELETE FROM reels WHERE reel_id='$reel_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('reel_view.php','_self');</script>";
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
                                        <th>Description</th>
                                        <th>Media</th>
                                        <th>Date</th>
                                        <th>Likes</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_reel = "SELECT * FROM reels ORDER BY reel_id ASC";
                                    $run_reel =  mysqli_query($conn, $select_reel);
                                    while ($row_reel =  mysqli_fetch_array($run_reel)) {

                                        $reel_id =  $row_reel['reel_id'];
                                        $reel_title =  $row_reel['reel_title'];
                                        $reel_des =  $row_reel['reel_des'];
                                        $reel_date =  $row_reel['reel_date'];
                                        $reel_likes =  $row_reel['reel_likes'];
                                        $reel_media =  $row_reel['reel_media'];
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo $reel_id; ?></td>
                                            <td><?php echo $reel_title; ?></td>
                                            <td><?php echo $reel_des; ?></td>
                                            <td><?php echo $reel_media; ?></td>
                                            <td><?php echo $reel_date; ?></td>
                                            <td><?php echo $reel_likes; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="reel_view.php?del=<?php echo $reel_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="reel_edit.php?edit=<?php echo $reel_id; ?>">Edit</a></li>
                                                        <li><a class="dropdown-item" href="reel_comments.php?reel=<?php echo $reel_id; ?>">Comments </a></li>
                                                      
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