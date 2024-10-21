<?php require_once('parts/top.php'); 
$page = "setting";
?>

<script src="https://cdn.tiny.cloud/1/kyfy8awdaayfu3y0qtf0sfwngkkz6tlwrqh3e6dposbokpfo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
                            <?php 					
                                require_once('parts/db.php'); 

                                if(isset($_GET['del'])){
                                    $del_id = $_GET['del'];

                                $delete_genre= "DELETE FROM page WHERE page_id='$del_id'";
                                $run = mysqli_query($conn,$delete_genre);

                                if($run === true){
                                    echo "<script>window.open('page.php','_self');</script> ";
                                }else{
                                    echo "Failed,Try Again";
                                    }
                                }

                            ?>
        <div class="app-title">
            <div>
                <h1><i class="bi bi-patch-question"></i> Page</h1>
                <p>Enter Details</p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="page_title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">URL</label>
                                            <input type="text" class="form-control" name="page_url">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Page Content</label>
                                            <textarea type="text" class="form-control" name="page_content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="mb-3">
                                    <input type="submit" name="insert_btn" value="Add Record" class="btn btn-primary">
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

                                <?php
                                require_once('parts/db.php');
                                if (isset($_POST['insert_btn'])) {

                                    $page_title = $_POST['page_title'];
                                    $page_url = $_POST['page_url'];
                                    $page_content = $_POST['page_content'];


                                    $insert_setting = "INSERT INTO page(
                                        page_title,
                                        page_url,
                                        page_content)VALUES(
                                            '$page_title',
                                            '$page_url',
                                            '$page_content')";

                                    $run_setting = mysqli_query($conn, $insert_setting);

                                    if ($run_setting == true) {
                                        //echo "data is inserted ";
                                        echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
                                        Record Saved!
                                      </div>
                                
                                      <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                          var myAlert = document.getElementById("myAlert");
                                          myAlert.style.display = "block";
                                
                                          setTimeout(function () {
                                            myAlert.style.display = "none";
                                            window.location.href = "page.php";
                                          }, 2000);
                                        });
                                      </script>';
									  
									
                                    } else {
                                        //echo "fail";
                                        echo "<script>alert('Failed');</script>";
                                    }
                                }

                                ?>
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card ">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                      <div class="card-body">
                        <table class="table table-bordered">
                         <thead>
                          <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>DETAILS</th>
                            <th>Action</th>
                          </tr>
                         </thead>
                         <tbody>
                 		<?php
							  require_once('parts/db.php');
								  $select_setting = "SELECT * FROM page ORDER BY page_id DESC";
								  $run_select_setting = mysqli_query($conn,$select_setting);
								   while($row_setting = mysqli_fetch_array($run_select_setting)){
									   
										
								
    								$page_id = $row_setting['page_id'];
    								$page_title = $row_setting['page_title'];
    								$page_url = $row_setting['page_url'];
    								$page_content = $row_setting['page_content'];

    								
    								
							  ?>
                           <tr>  
                            <td><?php echo $page_id;?></td>
                             <td><?php echo $page_title;?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModalview<?php echo $page_id;?>" href="page.php?book_id=<?php echo $page_id; ?>">View Page</button>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success btn-sm  dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
            
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="page.php?del=<?php echo $page_id; ?>">Delete</a></li>
                                        <li><a class="dropdown-item"data-bs-toggle="modal" data-bs-target="#myModaledit<?php echo $page_id;?>" href="page.php?book_id=<?php echo $page_id; ?>">Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                            
                            <!-- The Modal for Edit-->
                            <div class="modal" id="myModalview<?php echo $page_id;?>">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                            
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Page View</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                            
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="play-area bg-white p-3">
                                                <?php echo $page_content;?>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                  </div>
                            
                                </div>
                              </div>
                            </div>

                            <!-- The Modal for Edit-->
                            <div class="modal" id="myModaledit<?php echo $page_id;?>">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                            
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Update Record</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                            
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="play-area bg-white p-3">
                                              <form action="" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Title</label>
                                                            <input type="text" class="form-control" name="page_title" value="<?php echo $page_title;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">URL</label>
                                                            <input type="text" class="form-control" name="page_url" value="<?php echo $page_url?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Page Content</label>
                                                            <textarea type="text" class="form-control" name="page_content"><?php echo $page_content;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <input type="hidden" name="page_id" value="<?php echo $page_id;?>">
                                                
                                                <div class="mb-3">
                                                    <input type="submit" name="update_btn" value="Edit Record" class="btn btn-primary">
                                                </div>
                                             </form>
                
                                               
                                            </div>
                                        </div>
                                    </div>
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
                       </tbody> 
                     </table>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          <!-- / Content -->

          <!-- Footer -->
           <?php
                require_once('parts/db.php');
                if (isset($_POST['update_btn'])) {
        
                $epage_id = $_POST['page_id'];
                $epage_content_title = $_POST['page_title'];
                $epage_url = $_POST['page_url'];
                $epage_content = str_replace("'", "\'",$_POST['page_content']);


                    $update_page = "UPDATE page SET page_title='$epage_content_title',page_url='$epage_url',page_content='$epage_content' WHERE page_id='$epage_id;'";
        
                    $run_update_page = mysqli_query($conn, $update_page);
        
                    if ($run_update_page == true) {
                        //echo "data is inserted ";
                        echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
                        Record Saved!
                      </div>
                
                      <script>
                        document.addEventListener("DOMContentLoaded", function () {
                          var myAlert = document.getElementById("myAlert");
                          myAlert.style.display = "block";
                
                          setTimeout(function () {
                            myAlert.style.display = "none";
                            window.location.href = "page.php";
                          }, 0);
                        });
                      </script>';
        			  
        			
                    } else {
                        //echo "fail";
                        echo "<script>alert('Failed');</script>";
                    }
                }
        
                ?>
    </main>
<!-- Essential javascripts for application to work-->
<?php require_once('parts/footer.php'); ?>