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
                <h1><i class="bi bi-camera-reels"></i> Reel Comments</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Reel Comments</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
						
						<?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['hide'])){
                            $hide_id = $_GET['hide'];
                        if($_GET['status'] == 'Active'){
                            $u_status = "Hide";
                        }else{
                            $u_status = "Active";
                        }
						$hide = "UPDATE comments SET comment_status='$u_status' WHERE reel_id='$hide_id'";
						$run = mysqli_query($conn,$hide);

						if($run === true){
							echo "<script>alert('Hide');</script>";
							echo "<script>window.open('reel_comments.php?reel=$hide_id','_self');</script>";
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
                                        <th>User</th>
                                        <th>Comments</th>
                                        <th>Comment_status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_GET['reel'])){
                                        $reel_id = $_GET['reel'];

                                    $select_reel = "SELECT * FROM reels WHERE reel_id='$reel_id' ORDER BY reel_id ASC";
                                    $run_reel =  mysqli_query($conn, $select_reel);
                                    $row_reel =  mysqli_fetch_array($run_reel);

                                        $reel_id =  $row_reel['reel_id'];
                                        $reel_title =  $row_reel['reel_title'];
                                        $reel_des =  $row_reel['reel_des'];
                                        $reel_date =  $row_reel['reel_date'];
                                        $reel_likes =  $row_reel['reel_likes'];
                                        $reel_media =  $row_reel['reel_media'];
                                    
                                    $select_comment = "SELECT * FROM comments WHERE reel_id='$reel_id'";
                                    $run_comment = mysqli_query($conn,$select_comment);
                                    while($row_comment = mysqli_fetch_array($run_comment)){
                                        
                                        $comment_id = $row_comment['comment_id'];
                                        $reel_id = $row_comment['reel_id'];
                                        $user_token = $row_comment['user_token'];
                                        $comment_des = $row_comment['comment_des'];
                                        $comment_status = $row_comment['comment_status'];
                                        
                                        if($user_token !== 'Admin'){
                                        $select_user = "SELECT * FROM user WHERE user_token='$user_token'";
                                        $run_user =  mysqli_query($conn, $select_user);
                                        $row_user =  mysqli_fetch_array($run_user);
                                            
                                            $user_email = preg_replace("/(^...|........$)(*SKIP)(*F)|(.)/","*",$row_user['user_email']);
                                        
                                        }else{
                                            $user_email = 'Admin';
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $comment_id; ?></td>
                                            <td><?php echo $reel_title; ?></td>
                                            <td><?php echo $user_email; ?></td>
                                            <td><?php echo $comment_des; ?></td>
                                            <td><?php echo $comment_status; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="reel_comments.php?hide=<?php echo $reel_id; ?>&status=<?php echo $comment_status; ?>">Hide</a></li>
                                                      
                                                    </ul>
                                                </div>
                                            </td>
									   </tr>
                                    <?php }}else{
                                        echo"<script>window.open('reel_view.php','_self')</script>";
                                    } ?>
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