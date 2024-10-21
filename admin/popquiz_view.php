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
                <h1><i class="bi bi-files"></i> Pop Quiz Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Pop Quiz Record</a></li>
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

						$delete = "DELETE FROM popquiz WHERE popquiz_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('popquiz_view.php','_self');</script>";
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
                                        <th>Instructions</th>
                                        <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3</th>
                                        <th>Option 4</th>
                                        <th>Answer</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_popquiz = "SELECT * FROM popquiz ORDER BY popquiz_id DESC";
                                    $run_popquiz =  mysqli_query($conn, $select_popquiz);
                                    while ($row_popquiz =  mysqli_fetch_array($run_popquiz)) {

                                        $popquiz_id =  $row_popquiz['popquiz_id'];
                                        $popquiz_title =  $row_popquiz['popquiz_title'];
                                        $popquiz_instructions =  $row_popquiz['popquiz_instructions'];
                                        $popquiz_option1 =  $row_popquiz['popquiz_option1'];
                                        $popquiz_option2 =  $row_popquiz['popquiz_option2'];
                                        $popquiz_option3 =  $row_popquiz['popquiz_option3'];
                                        $popquiz_option4 =  $row_popquiz['popquiz_option4'];
                                        $popquiz_answer =  $row_popquiz['popquiz_answer'];
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo $popquiz_id; ?></td>
                                            <td><?php echo $popquiz_title; ?></td>
                                            <td><?php echo $popquiz_instructions; ?></td>
                                            <td><img height="50px;" src="upload/<?php echo $popquiz_option1;?>"></td>
                                            <td><img height="50px;" src="upload/<?php echo $popquiz_option2;?>"></td>
                                            <td><img height="50px;" src="upload/<?php echo $popquiz_option3;?>"></td>
                                            <td><img height="50px;" src="upload/<?php echo $popquiz_option4;?>"></td>
                                            <td><?php echo $popquiz_answer; ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="popquiz_view.php?del=<?php echo $popquiz_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="popquiz_edit.php?edit=<?php echo $popquiz_id; ?>">Edit</a>
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