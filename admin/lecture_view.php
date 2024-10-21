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
                <h1><i class="bi bi-person-video3"></i> Lecture Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Lecture Record</a></li>
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
                            $lecture_id = $_GET['del'];

						$delete = "DELETE FROM lectures WHERE lecture_id='$lecture_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('lecture_view.php','_self');</script>";
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
                                        <th>Tumbnail</th>
                                        <th>Date</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_lecture = "SELECT * FROM lectures ORDER BY lecture_id ASC";
                                    $run_lecture =  mysqli_query($conn, $select_lecture);
                                    while ($row_lecture =  mysqli_fetch_array($run_lecture)) {

                                        $lecture_id =  $row_lecture['lecture_id'];
                                        $lecture_title =  $row_lecture['lecture_title'];
                                        $lecture_media =  $row_lecture['lecture_media'];
                                        $lecture_img =  $row_lecture['lecture_img'];
                                        $lecture_date =  $row_lecture['lecture_date'];
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo $lecture_id; ?></td>
                                            <td><?php echo $lecture_title; ?></td>
                                            <td><img height="50px" src="upload/<?php echo $lecture_img; ?>"></td>
                                            <td><?php echo $lecture_date; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="lecture_view.php?del=<?php echo $lecture_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="lecture_edit.php?edit=<?php echo $lecture_id; ?>">Edit</a></li>
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