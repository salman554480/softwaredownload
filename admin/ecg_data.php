<?php require_once('parts/top.php'); ?>
</head>
<body class="app sidebar-mini">
   <!-- Navbar-->
   <?php require_once('parts/navbar.php'); ?> 
   <!-- Sidebar menu-->
   <?php require_once('parts/sidebar.php'); ?>
   <?php
      if(isset($_GET['ecg_id'])){
          $ecg_id = $_GET['ecg_id'];
      
      
      $select_ecg = "SELECT * FROM ecg WHERE ecg_id='$ecg_id'";
      $run_ecg = mysqli_query($conn,$select_ecg);
      $row_ecg = mysqli_fetch_array($run_ecg);
      
      $ecg_id =  $row_ecg['ecg_id'];
      $ecg_title =  $row_ecg['ecg_title'];
      $ecg_details =  $row_ecg['ecg_details'];
      $ecg_image =  $row_ecg['ecg_image'];
      $ecg_level =  $row_ecg['ecg_level'];
      $ecg_exp =  $row_ecg['ecg_explanation'];
      $ecg_exp_img =  $row_ecg['ecg_explanation_img'];
      }
      ?>
   <main class="app-content">
      <div class="app-title">
         <div>
            <h1><i class="bi bi-heart-pulse"></i> ECG Record</h1>
            <p><?php echo $ecg_title;?></p>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="tile">
               <div class="tile-body">
                  <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                     <div class="mb-3 row">
                        <div class="col-md-6 mt-3">
                           <label class="form-label"><b>Title</b></label>
                           <input class="form-control" value="<?php echo $ecg_title;?>" name="ecg_title" type="text" required>
                        </div>
                         <div class="col-md-6 mt-3">
                           <label class="form-label"><b>Level</b></label>
                           <select type="text" class="form-control" name="ecg_level" value="<?php echo $ecg_level; ?>">
                              <option><?php echo $ecg_level; ?></option>
                              <option>Beginner</option>
                              <option>Resident</option>
                              <option>Cardiologist</option>
                              <option>Other</option>
                           </select>
                        </div>
                        <div class="col-md-6 mt-3">
                           <label class="form-label"><b>Image</b></label>
                           <input class="form-control" value="<?php echo $ecg_image;?>" name="ecg_image" type="file">
                           <img height="40px" src="upload/<?php echo $ecg_image;?>">
                        </div>
                       
                        
                        <div class="col-md-6 mt-3">
                           <label class="form-label"><b>Visual Explaination</b></label>
                           <input class="form-control" value="<?php echo $ecg_exp_img;?>" name="ecg_explanation_img" type="file">
                           <img height="40px" src="upload/<?php echo $ecg_exp_img;?>">
                        </div>
                        
                        <div class="col-md-12 mt-3">
                           <label class="form-label"><b>Explanation</b></label>
                           <textarea class="form-control"  name="ecg_explanation" required><?php echo $ecg_exp;?></textarea>
                        </div>
                     </div>
                     <div class="mb-3 row">
                        <div class="col-md-12">
                           <input class="btn btn-success" name="update_ecg" type="submit" value="Edit Record">
                        </div>
                     </div>
                  </form>
                  <?php
                     require_once('parts/db.php');
                     if(isset($_POST['update_ecg'])){
                     
                     	$aecg_title = $_POST['ecg_title'];
                     	$aecg_image = $_FILES['ecg_image']['name'];
                     	$aecg_tmp_name = $_FILES['ecg_image']['tmp_name'];
                     	$aecg_level = $_POST['ecg_level'];
                     	$aecg_exp = $_POST['ecg_explanation'];
                     	$aecg_exp_img = $_FILES['ecg_explanation_img']['name'];
                     	$aecg_exp_img_tmp = $_FILES['ecg_explanation_img']['tmp_name'];
                     	
                     	$aecg_exp = str_replace("'", "\'", $aecg_exp);
                     	
                           if($aecg_image ==  ""){
     				
                               $aecg_image = $ecg_image;
                           }
                           
                           if($aecg_exp_img ==  ""){
                                   
                                   $aecg_exp_img = $ecg_exp_img;
                               }
                     	
                     	$update_ecg = "UPDATE ecg SET ecg_title='$aecg_title',ecg_image='$aecg_image',ecg_level='$aecg_level',ecg_explanation='$aecg_exp',ecg_explanation_img='$aecg_exp_img' WHERE ecg_id='$ecg_id'";
                     	
                     	$run_ecg = mysqli_query($conn,$update_ecg);
                     	
                     	if($run_ecg == true){
                     		//echo "data is inserted ";
                     		move_uploaded_file($aecg_tmp_name,"upload/$aecg_image");
                     		move_uploaded_file($aecg_exp_img_tmp,"upload/$aecg_exp_img");
                     		echo "<script>alert('ECG Update');</script>";
                     		echo "<script>window.open('ecg_data.php?ecg_id=$ecg_id','_self');</script>";
                     	}else{
                     		//echo "fail";
                     		echo "<script>alert('Failed');</script>";
                     	}
                     	
                     	
                     }
                          
                           ?>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="tile">
               <div class="tile-body">
                  <div class="d-flex justify-content-between">
                     <h4>
                     Right Answers/Codes</h5>
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                     Add Right Codes
                     </button>-->
                     <!-- The Modal -->
                     <div class="modal" id="myModal">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                 <h4 class="modal-title">Modal Heading</h4>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                                 Modal body..
                              </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <table class="table table-bordered">
                     <?php
                        $select_code = "SELECT * FROM sectionanswers WHERE ecg_id='$ecg_id'";
                        $run_code = mysqli_query($conn,$select_code);
                        while($row_code = mysqli_fetch_array($run_code)){
                        
                        $sectionanswers_id =  $row_code['sectionanswers_id'];
                        $get_sectionoption_id =  $row_code['sectionoption_id'];
                        
                        
                        $select_sectionoption = "SELECT * FROM sectionoption WHERE sectionoption_id='$get_sectionoption_id'";
                                $run_sectionoption =  mysqli_query($conn, $select_sectionoption);
                               $row_sectionoption =  mysqli_fetch_array($run_sectionoption);
                        
                                    $sectionoption_id =  $row_sectionoption['sectionoption_id'];
                                    $section_id =  $row_sectionoption['section_id'];
                                    $sectionoption_name =  $row_sectionoption['sectionoption_name'];
                        
                        ?>
                     <tr>
                        <td><?php echo $sectionoption_name; ?> </td>
                        <td><a href="delete.php?del=<?php echo $sectionanswers_id; ?>&table=sectionanswers">Delete</a></td>
                        
                        <td><button class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#rightcodes<?php echo $sectionanswers_id;?>">Edit</button></td>
                        
                         <!-- Edit Modal -->
                         <div class="modal" id="rightcodes<?php echo $sectionanswers_id;?>">
                            <div class="modal-dialog modal-lg">
                               <div class="modal-content">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                     <h4 class="modal-title">Edit Right Codes</h4>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                           <div class="col-md-12 mt-3">
                                              <input type="hidden" name="edit_opid" value="<?php echo $sectionanswers_id; ?>"/>
                                              <label class="form-label"><b>Right Options</b></label>
                                                <select class="form-control" name="sectionoption_id" >
                                                    <?php 
                                                    $select_option = "SELECT * FROM sectionoption ORDER BY sectionoption_name ASC";
                                                    $run_select_option =  mysqli_query($conn,$select_option);
                                                    while($row_select_option = mysqli_fetch_array($run_select_option)){
                                                        
                                                        $db_sectionoption_id =  $row_select_option['sectionoption_id'];
                                                        $db_sectionoption_name =  $row_select_option['sectionoption_name'];
                                                    ?>
                                                    <option value="<?php echo $db_sectionoption_id; ?>" <?php if($db_sectionoption_id == $get_sectionoption_id){echo "selected"; } ?>><?php echo $db_sectionoption_name; ?></option>
                                                    <?php } ?>
                                                </select>   
                                           </div>
                                        </div>
                                             <div class="col-md-12 mt-3">
                                                <input class="btn btn-success" name="edit_codes" type="submit" value="Edit Record"  required>
                                             </div>
                                     </form>
                                     <?php
                                     require_once('parts/db.php');
                                      if (isset($_POST["edit_codes"])) {

									     $esectionoption_id = $_POST['sectionoption_id'];
									     $edit_opid = $_POST['edit_opid'];
                                    
                                         $update_sectionoption = "UPDATE sectionanswers SET sectionoption_id='$esectionoption_id' WHERE sectionanswers_id='$edit_opid'";
        							
        							     $run_sectionoption = mysqli_query($conn,$update_sectionoption);
                                     
                                     
                                      }
                                     ?>
                                  </div>
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                  </div>
                               </div>
                            </div>
                         </div>
                        
                     </tr>
                     <?php } ?>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="tile">
               <div class="tile-body">
                  <div class="d-flex justify-content-between">
                     <h4>
                     Question Answers</h5>
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myquestion">
                     Add Questions
                     </button>
                     <!-- The Modal -->
                     <div class="modal" id="myquestion">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                 <h4 class="modal-title">Add Questions </h4>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                                 <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3 row">
                                       
                                       <div class="col-md-12 mt-3">
                                          <label class="form-label"><b>Title</b></label>
                                          <input class="form-control" name="question_title" type="text" required>
                                       </div>
                                       <div class="col-md-12 mt-3">
                                          <label class="form-label"><b>Right Answer</b></label>
                                          <input class="form-control" name="question_right_answer" type="text" required>
                                       </div>
                                    </div>
                                    <div class="row mt-3">
                                       <div class="col-md-12">
                                          <h5>Add Options</h5>
                                          <div class="row">
                                             <div class="col-md-9">
                                                <div id="fieldsContainer">
                                                   <!-- Initial textbox -->
                                                   <div class="d-flex">
                                                      <input class="form-control" placeholder="Enter Text" type="text" name="field[]" required>
                                                      <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove </button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-3">
                                                <button type="button" class="btn btn-success btn-sm" onclick="addMoreFields()">Add More Option</button>
                                             </div>
                                          </div>
                                          <div class="mb-3 row mt-3">
                                             <div class="col-md-12">
                                                <input class="btn btn-success" name="insert_btn" type="submit" value="Add Record"  required>
                                             </div>
                                          </div>
                                 </form>
                                 <script>
                                    function addMoreFields() {
                                        var container = document.getElementById("fieldsContainer");
                                        var newDiv = document.createElement("div");
                                        newDiv.classList.add("d-flex", "my-2");
                                    
                                    
                                        var input = document.createElement("input");
                                        input.type = "text";
                                        input.placeholder = "Enter Text";
                                        input.classList.add("form-control");
                                        input.name = "field[]";
                                        newDiv.appendChild(input);
                                    
                                        var removeButton = document.createElement("button");
                                        removeButton.type = "button";
                                        removeButton.classList.add("btn", "btn-danger");
                                        removeButton.textContent = "Remove ";
                                        removeButton.onclick = function() {
                                            container.removeChild(newDiv);
                                        };
                                        newDiv.appendChild(removeButton);
                                    
                                        container.appendChild(newDiv);
                                    }
                                    
                                    function removeField(div) {
                                        var container = document.getElementById("fieldsContainer");
                                        container.removeChild(div.parentNode);
                                    }
                                 </script>
                                 <?php
								require_once('parts/db.php');
                                        
								 if ($_SERVER["REQUEST_METHOD"] === "POST") {
								    // Connect to your database (replace these values with your database 
                                    // Process and insert records
                                    if (isset($_POST["insert_btn"])) {

										$ecg_level = $_POST['ecg_level'];
										$question_title = $_POST['question_title'];
										$question_right_answer = $_POST['question_right_answer'];
										
                                        
                                        $question_no_check = mysqli_query($conn,"SELECT * FROM question WHERE ecg_id='$ecg_id' ORDER BY question_id ASC"); 
                                        $question_no = mysqli_num_rows($question_no_check);
                                        
                                        if($question_no == 0){
                                            $question_no = 1;
                                        }else{
                                            $question_no = $question_no + 1;
                                        }


										$insert_question = "INSERT INTO question(ecg_id,question_no,ecg_level,question_title,question_right_answer)VALUES('$ecg_id','$question_no','$ecg_level','$question_title','$question_right_answer')";
				
										$run_question = mysqli_query($conn,$insert_question);
										
										if($run_question == true){
											$get_question =  "SELECT * FROM question ORDER BY question_id DESC LIMIT 1";
											$run_get_question =  mysqli_query($conn,$get_question);
											$row_get_question =  mysqli_fetch_array($run_get_question);
											
											$question_no =  $row_get_question['question_no'];
										}
										
										
                                       $fields = $_POST["field"];
                                        foreach ($fields as $field) {
                                            // Perform any necessary validation and sanitization
                                          $field = mysqli_real_escape_string($conn, $field);

                                            // Insert the record into your database (replace 'your_table' with your actual table name)
                                            $sql = "INSERT INTO option (ecg_id,ecg_level,question_no,option_title,option_status) VALUES ('$ecg_id','$ecg_level','$question_no','$field','active')";
                                         
											 $run = mysqli_query($conn, $sql);
											 
											 
											}
											
										}

                                   
                                    // Close the database connection
                                    $conn->close();
                                    
                                    
 



                                    // Redirect or perform any other actions after inserting records
                                    echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
                                        Questions Added!</br>
                                        <a href="question_view.php">View Questions</a>
                                      </div>
                                
                                      <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                          var myAlert = document.getElementById("myAlert");
                                          myAlert.style.display = "block";
                                
                                          setTimeout(function () {
                                            myAlert.style.display = "none";
                                           window.location.href = "ecg_data.php?ecg_id=' . $ecg_id . '";
                                          }, 0);
                                        });
                                      </script>';
                                    exit();
								 }
                                ?>
                                 </div>
                                 <!-- Modal footer -->
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                 </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <table class="table table-bordered">
                     <tr>
                        <th>Question No</th>
                        <th>Question</th>
                        <th>Right Answer</th>
                        <th>Options</th>
                        <th>Delete</th>
                        <th>Edit</th>
                     </tr>
                     <?php
                        $select_question = "SELECT * FROM question WHERE ecg_id='$ecg_id'";
                        $run_question = mysqli_query($conn,$select_question);
                        while($row_question = mysqli_fetch_array($run_question)){
                        
                        $question_id =  $row_question['question_id'];
                        $question_no =  $row_question['question_no'];
                        $question_title =  $row_question['question_title'];
                        $question_right_answer =  $row_question['question_right_answer'];
                        
                        ?>
                     <tr>
                        <td><?php echo $question_no; ?></td>
                        <td><?php echo $question_title; ?></td>
                        <td><?php echo $question_right_answer; ?></td>
                        <td><small>
                           <?php
                              $select_option = "SELECT * FROM option WHERE question_no='$question_no' and ecg_id='$ecg_id'";
                              $run_option =  mysqli_query($conn, $select_option);
                              while($row_option =  mysqli_fetch_array($run_option)){
                              $option_id =  $row_option['option_id'];
                               echo   $option_title =  $row_option['option_title'] ." (<a href='question_option_edit.php?edit=$option_id'>Edit </a> |  <a href='delete.php?del=$option_id&table=option'>Delete </a>)". "<br>";
                              }
                              ?>
                           </small>
                        </td>
                        <td><a href="delete.php?del=<?php echo $question_id; ?>&table=question">Delete</a></td>
                        <td><a href="question_edit.php?edit=<?php echo $question_id;?>">Edit</a></td>
                     </tr>
                     <?php } ?>
                  </table>
               </div>
            </div>
         </div>
      </div>
      
      <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                    <div class="d-flex justify-content-between">
                     <h4>PopQuiz</h4>
                     <a  href="popquiz_add.php?ecg_id=<?php echo $ecg_id; ?>"><button type="button" class="btn btn-primary">
                     Add Popquiz
                     </button></a>
                    
                     </div>
                     
                    
                        
                        <div class="table-responsive">
						
						<?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "DELETE FROM popquiz WHERE popquiz_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('ecg_data.php?ecg_id=$ecg_id','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="">
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
                                    $select_popquiz = "SELECT * FROM popquiz WHERE ecg_id='$ecg_id' ORDER BY popquiz_id DESC ";
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
                                                        <li><a class="dropdown-item" href="delete.php?del=<?php echo $popquiz_id; ?>&table=popquiz">Delete</a></li>
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
