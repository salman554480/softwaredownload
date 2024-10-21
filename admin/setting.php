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

    $delete_genre= "DELETE FROM setting WHERE setting_id='$del_id'";
    $run = mysqli_query($conn,$delete_genre);

    if($run === true){
        echo "<script>window.open('setting.php','_self');</script> ";
    }else{
        echo "Failed,Try Again";
        }
    }

?>
        <div class="app-title">
            <div>
                <h1><i class="bi bi-patch-question"></i> Settings</h1>
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
                                            <input type="text" class="form-control" name="website_title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">URL</label>
                                            <input type="text" class="form-control" name="website_url">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Logo</label>
                                            <input type="file" class="form-control" name="website_logo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Favicon</label>
                                            <input type="file" class="form-control" name="website_favicon">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Primary Color</label>
                                            <input type="text" class="form-control" name="website_primary_color">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Secondary Color</label>
                                            <input type="text" class="form-control" name="website_secondary_color">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="admin_email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Head Code</label>
                                            <textarea type="text" class="form-control" name="website_head_code"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Footer Code</label>
                                            <textarea type="text" class="form-control" name="website_footer_code"></textarea>
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

                                    $Website_title = $_POST['website_title'];
                                    $Website_url = $_POST['website_url'];
                                    $Website_logo = $_FILES['website_logo']['name'];
                                    $Website_logo_tmp = $_FILES['website_logo']['tmp_name'];
                                    $Website_favicon = $_FILES['website_favicon']['name'];
                                    $Website_favicon_tmp = $_FILES['website_favicon']['tmp_name'];
                                    $Website_primary_color = $_POST['website_primary_color'];
                                    $Website_secondary_color = $_POST['website_secondary_color'];
                                    $Admin_email = $_POST['admin_email'];
                                    $Website_head_coode = $_POST['website_head_code'];
                                    $Website_footer_code = $_POST['website_footer_code'];


                                    $insert_setting = "INSERT INTO setting(
                                        website_title,
                                        website_url,
                                        website_logo,
                                        website_favicon,
                                        website_primary_color,
                                        website_secondary_color,
                                        admin_email,
                                        website_head_code,
                                        website_footer_code)VALUES(
                                            '$Website_title',
                                            '$Website_url',
                                            '$Website_logo',
                                            '$Website_favicon',
                                            '$Website_primary_color',
                                            '$Website_secondary_color',
                                            '$Admin_email',
                                            '$Website_head_coode',
                                            '$Website_footer_code')";

                                    $run_setting = mysqli_query($conn, $insert_setting);

                                    if ($run_setting == true) {
                                        //echo "data is inserted ";
                                        move_uploaded_file($Website_logo_tmp,"upload/$Website_logo");
                                        move_uploaded_file($Website_favicon_tmp,"upload/$Website_favicon");
                                        echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
                                        Record Saved!
                                      </div>
                                
                                      <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                          var myAlert = document.getElementById("myAlert");
                                          myAlert.style.display = "block";
                                
                                          setTimeout(function () {
                                            myAlert.style.display = "none";
                                            window.location.href = "setting.php";
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
                            <th>Logo </th>
                            <th>Favcion</th>
							<th>Primary Color</th>
							<th>Secondary Color</th>
                            <th>Admin Email</th>
                            <th>Head Code </th>
                            <th>Footer Code</th>
                             <th>Action</th>
                          </tr>
                         </thead>
                         <tbody>
                 		<?php
							  require_once('parts/db.php');
								  $select_setting = "SELECT * FROM setting ORDER BY setting_id DESC";
								  $run_select_setting = mysqli_query($conn,$select_setting);
								   while($row_setting = mysqli_fetch_array($run_select_setting)){
									   
										
								
    								$setting_id = $row_setting['setting_id'];
    								$website_title = $row_setting['website_title'];
    								$website_url = $row_setting['website_url'];
    								$website_logo = $row_setting['website_logo'];
    								$website_favicon = $row_setting['website_favicon'];
    								$website_primary_color = $row_setting['website_primary_color'];
    								$website_secondary_color = $row_setting['website_secondary_color'];
    								$admin_email = $row_setting['admin_email'];
    								$website_head_code = $row_setting['website_head_code'];
    								$website_footer_code = $row_setting['website_footer_code'];

    								
    								
							  ?>
                           <tr>  
                            <td><?php echo $setting_id;?></td>
                             <td><?php echo $website_title;?></td>
                            <td><?php echo $website_url;?></td>
							<td><img src="upload/<?php echo $website_logo;?>" height="30px;"></td>
							<td><img src="upload/<?php echo $website_favicon;?>" height="30px;"></td>
                            <td><?php echo $website_primary_color;?></td>
                            <td><?php echo $website_secondary_color;?></td>
                            <td><?php echo $admin_email;?></td>
                            <td><?php echo $website_head_code;?></td>
                            <td><?php echo $website_footer_code;?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success btn-sm  dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
            
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="setting.php?del=<?php echo $setting_id; ?>">Delete</a></li>
                                        <li><a class="dropdown-item"data-bs-toggle="modal" data-bs-target="#myModaledit<?php echo $setting_id;?>" href="setting.php?book_id=<?php echo $setting_id; ?>">Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                            
                            <!-- The Modal -->
                            <div class="modal" id="myModaledit<?php echo $setting_id;?>">
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
                                                            <input type="text" class="form-control" name="website_title" value="<?php echo $website_title;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">URL</label>
                                                            <input type="text" class="form-control" name="website_url" value="<?php echo $website_url?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Logo</label>
                                                            <input type="file" class="form-control" name="website_logo">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Favicon</label>
                                                            <input type="file" class="form-control" name="website_favicon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Primary Color</label>
                                                            <input type="text" class="form-control" name="website_primary_color" value="<?php echo $website_primary_color;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Secondary Color</label>
                                                            <input type="text" class="form-control" name="website_secondary_color" value="<?php echo $website_secondary_color;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Admin Email</label>
                                                            <input type="text" class="form-control" name="admin_email" value="<?php echo $admin_email;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Head Code</label>
                                                            <textarea type="text" class="form-control" name="website_head_code"><?php echo $website_head_code;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Footer Code</label>
                                                            <textarea type="text" class="form-control" name="website_footer_code"><?php echo $website_footer_code;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <input type="hidden" name="setting_id" value="<?php echo $setting_id;?>">
                                                <input type="hidden" name="oldlogo" value="<?php echo $website_logo; ?>">
												<input type="hidden" name="oldicon" value="<?php echo $website_favicon; ?>">
                                                
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
        
                $esetting_id = $_POST['setting_id'];
                $eWebsite_title = $_POST['website_title'];
                $eWebsite_url = $_POST['website_url'];
                $eWebsite_logo = $_FILES['website_logo']['name'];
                $eWebsite_logo_tmp = $_FILES['website_logo']['tmp_name'];
                $eWebsite_favicon = $_FILES['website_favicon']['name'];
                $eWebsite_favicon_tmp = $_FILES['website_favicon']['tmp_name'];
                $eWebsite_primary_color = $_POST['website_primary_color'];
                $eWebsite_secondary_color = $_POST['website_secondary_color'];
                $eAdmin_email = $_POST['admin_email'];
                $eWebsite_head_coode = $_POST['website_head_code'];
                $eWebsite_footer_code = $_POST['website_footer_code'];

                $oldLogo = $_POST['oldlogo'];
				
				$oldIcon = $_POST['oldicon'];
                
                if($eWebsite_logo ==  ""){
					
					$eWebsite_logo = $oldLogo;
				}
				
				if($eWebsite_favicon ==  ""){
					
					$eWebsite_favicon = $oldIcon;
				}



                    $update_setting = "UPDATE setting SET website_title='$eWebsite_title',website_url='$eWebsite_url',website_logo='$eWebsite_logo',website_favicon='$eWebsite_favicon',website_primary_color='$eWebsite_primary_color',website_secondary_color='$eWebsite_secondary_color',admin_email='$eAdmin_email',website_head_code='$eWebsite_head_coode',website_footer_code='$eWebsite_footer_code' WHERE setting_id='$esetting_id;'";
        
                    $run_update_setting = mysqli_query($conn, $update_setting);
        
                    if ($run_update_setting == true) {
                        //echo "data is inserted ";
                        move_uploaded_file($eWebsite_logo_tmp,"upload/$eWebsite_logo");
						move_uploaded_file($eWebsite_favicon_tmp,"upload/$eWebsite_favicon");
                        echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
                        Record Saved!
                      </div>
                
                      <script>
                        document.addEventListener("DOMContentLoaded", function () {
                          var myAlert = document.getElementById("myAlert");
                          myAlert.style.display = "block";
                
                          setTimeout(function () {
                            myAlert.style.display = "none";
                            window.location.href = "setting.php";
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