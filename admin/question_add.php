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
                <h1><i class="bi bi-patch-question"></i> Add Question</h1>
                <p>Enter Details</p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                       <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Choose ECG</b></label>
                                    <select class="form-select" name="ecg_id" id="example-select">
										<?php
										 require_once('parts/db.php');
										 
										 $select_ecg = "SELECT * FROM ecg ORDER BY ecg_id DESC";
										 
										 $run_ecg = mysqli_query($conn,$select_ecg);
											while( $row_ecg = mysqli_fetch_array ($run_ecg)){

											$ecg_id = $row_ecg ['ecg_id'];
											$ecg_title = $row_ecg ['ecg_title'];		
										 
										 ?>
										<option value="<?php echo $ecg_id;?>"><?php echo $ecg_title;?></option>
												<?php } ?>	

									</select>	
                                </div>
								
						       <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Choose Level</b></label>
                                    <select type="text" class="form-control" name="ecg_level">
									 <option>Beginner</option>
									 <option>Technician</option> 
									 <option>Nurse</option>
									 <option>Resident</option>
									 <option>Fellow</option> 
									 <option>Physician</option>
									 <option>Specialist</option>
                                    </select>
                                </div>
								

                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Title</b></label>
                                    <input class="form-control" name="question_title" type="text" required>
                                </div>
                            
                            
                                <div class="col-md-6 mt-3">
                                    <label class="form-label"><b>Right Answer</b></label>
                                    <input class="form-control" name="question_right_answer" type="text" required>
                                </div>
								


                            </div>

						
									
						<div class="row mt-3">
						  <div class="col-md-12">
							<h5>Add Options</h5>	
							
							<div class="play-area bg-white ">
									<div class="row">
										<div class="col-md-8">
											<div id="fieldsContainer">
												<!-- Initial textbox -->
												<div class="d-flex">
													<input class="form-control" placeholder="Enter Text" type="text" name="field[]" required>
													<button type="button" class="btn btn-danger" onclick="removeField(this)">Remove </button>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<button type="button" class="btn btn-success" onclick="addMoreFields()">Add More Option</button>
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

										$ecg_id = $_POST['ecg_id'];
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
                                           window.location.href = "question_view.php";
                                          }, 2000);
                                        });
                                      </script>';
                                    exit();
								 }
                                ?>



                            </div>
                        </div>
			
			
			
			
			 
			
          
		            </div>
						
						
						
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <?php require_once('parts/footer.php'); ?>