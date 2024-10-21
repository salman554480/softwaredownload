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
                <h1><i class="bi bi-file-pdf"></i> Document Record</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Document Record</a></li>
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

						$delete = "DELETE FROM document WHERE document_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('document_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>
						
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Section</th>
                                        <th>Document</th>
                                        <th class="Hide-Table-column-Search">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_document = "SELECT * FROM document ORDER BY document_id DESC";
                                    $run_document =  mysqli_query($conn, $select_document);
                                    while ($row_document =  mysqli_fetch_array($run_document)) {

                                        $document_id =  $row_document['document_id'];
                                        $section_id =  $row_document['section_id'];
                                        $ducument =  $row_document['document'];

                                        
                                         $select_section = "SELECT * FROM section WHERE section_id='$section_id'";
											 
									    $run_section = mysqli_query($conn,$select_section);
										$row_section = mysqli_fetch_array ($run_section);

										$section_id = $row_section['section_id'];
										$section_name = $row_section['section_name'];
                                       

                                    ?>
                                        <tr>
                                            <td><?php echo $document_id; ?></td>
                                            <td><?php echo $section_name; ?></td>
                                            <td>
                                                <a href="upload/<?php echo $ducument; ?>" target="_blank" class="btn btn-sm btn-primary">Download</a> <br>
                                                <small><?php echo $ducument;?></small>    
                                            </td>

											<td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action 

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="document_view.php?del=<?php echo $document_id; ?>">Delete</a></li>
                                                        <li><a class="dropdown-item" href="document_edit.php?edit=<?php echo $document_id; ?>">Edit</a>
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