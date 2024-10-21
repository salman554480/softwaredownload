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
                <h1><i class="bi bi-speedometer"></i><b> Question Record</b></h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Question View</a></li>
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
                            $decg_id = $_GET['ecg'];

                            $select_dquestion = "SELECT * FROM question WHERE question_id='$del_id'";
                            $run_dquestion =  mysqli_query($conn, $select_dquestion);
                            $row_dquestion =  mysqli_fetch_array($run_dquestion);

                                $dquestion_no =  $row_dquestion['question_no'];

						$delete = "DELETE FROM question WHERE question_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
                            
                            $op_delete = "DELETE FROM option WHERE ecg_id='$decg_id' AND question_no='$dquestion_no'";
                            $op_drun = mysqli_query($conn,$op_delete);
                            if($run === true){
                                echo "<script>alert('Deleted');</script>";
                                echo "<script>window.open('question_view.php','_self');</script>";
                            }
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>Question Title</th>
                                        <th>Question Right Answer</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_question = "SELECT * FROM question ORDER BY question_id DESC";
                                    $run_question =  mysqli_query($conn, $select_question);
                                    while ($row_question =  mysqli_fetch_array($run_question)) {

                                        $question_id =  $row_question['question_id'];
                                        $ecg_id =  $row_question['ecg_id'];
                                        $question_no =  $row_question['question_no'];
                                        $ecg_level =  $row_question['ecg_level'];
                                        $question_title =  $row_question['question_title'];
                                        $question_right_answer =  $row_question['question_right_answer'];
                                        
                                        
                                        
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo "<b>".$question_title."</b></br>"; 

                                                    $select_option = "SELECT * FROM option WHERE ecg_id='$ecg_id' AND question_no='$question_no'";
                                                                                                
                                                    $run_option = mysqli_query($conn,$select_option);
                                                    while($row_option = mysqli_fetch_array ($run_option)){
                                                       echo $option_title = $row_option['option_title'];
                                                       echo "</br>";
                                                    }
                                            
                                                ?></td>
                                            <td><?php echo $question_right_answer; ?></td>
											
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="question_view.php?del=<?php echo $question_id; ?>&ecg=<?php echo $ecg_id; ?>">Delete</a></li>
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