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
                <h1><i class="bi bi-speedometer"></i><b> Questions Result</b></h1>
                
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
                                        <th>User Token</th>
                                        <th>ECG</th>
                                        <th>Total</th>
                                        <th>Answers</th>
                                        <th>Correct</th>
                                        <th>Wrong</th>
                                        <th>Accuracy</th>
                                        <th>Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                            //$select_user = "SELECT * FROM user ORDER BY user_id DESC";
                            //$run_user =  mysqli_query($conn, $select_user);
                           // while ($row_user =  mysqli_fetch_array($run_user)) {

                             //   $user_id =  $row_user['user_id'];
                              //  $user_token =  $row_user['user_token'];
                                
                                    $select_answer = "SELECT * FROM answer";
                                    $run_answer =  mysqli_query($conn, $select_answer);
                                    $num_answer =  mysqli_num_rows($run_answer);
                                    while ($row_answer =  mysqli_fetch_array($run_answer)) {

                                        $answer_id  =  $row_answer['answer_id'];    
                                        $user_token =  $row_answer['user_token'];
                                        $ecg_id =  $row_answer['ecg_id'];
                                        $question_no =  $row_answer['question_no'];
                                        $user_answer =  $row_answer['user_answer'];
                                        $right_answer =  $row_answer['right_answer'];

                            ?>
                                        <tr>
                                            <td><?php echo $answer_id; ?></td>
                                            <td><?php echo $user_token; ?></td>
                                            <td><?php 
                                                $select_ecg = "SELECT * FROM ecg WHERE ecg_id='$ecg_id'";
                                                $run_ecg =  mysqli_query($conn, $select_ecg);
                                                $row_answer =  mysqli_fetch_array($run_ecg);
                                                echo $row_answer['ecg_title'];
                                                ?></td>
                                            <td><?php 
                                                $select_total = "SELECT * FROM question WHERE ecg_id='$ecg_id'";
                                                $run_total =  mysqli_query($conn, $select_total);
                                                $num_total =  mysqli_num_rows($run_total);
                                                echo $num_total;
                                                ?></td>
                                            <td><?php 
                                                $select_answers = "SELECT * FROM answer WHERE ecg_id='$ecg_id' AND user_token='$user_token'";
                                                $run_answers =  mysqli_query($conn, $select_answers);
                                                $num_answers =  mysqli_num_rows($run_answers);
                                                echo $num_answers;
                                                ?></td>
                                            <td><?php 
                                            echo  $select_correct = "SELECT * FROM answer WHERE ecg_id='$ecg_id' AND user_answer='$right_answer'";
                                                $run_correct =  mysqli_query($conn, $select_correct);
                                                $num_correct =  mysqli_num_rows($run_correct);
                                                echo $num_correct;
                                                ?></td>
                                            <td><?php 
                                                $num_wrong =  $num_answer - $num_correct;
                                                echo $num_wrong;
                                                ?></td>
                                            <td><?php 
                                                if($num_total == $num_answer){
                                                    $accuracy =  ($num_answer / $num_correct) * 100;
                                                     $accuracy.'%';
                                                }else{
                                                    echo "Quiz Pending";
                                                }
                                                ?></td>
                                            
											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="question_result.php?del=<?php echo $user_token; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="question_result.php?edit=<?php echo $user_token; ?>">Edit</a>
                                                        </li>
                                                      
                                                    </ul>
                                                </div>
                                            </td>
									   </tr>
                                    <?php }//} ?>
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