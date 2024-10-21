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
                <h1><i class="bi bi-speedometer"></i><b> Answer Record</b></h1>
                
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
                          <table class="table ">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Details</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr data-toggle="collapse" data-target="#details1" class="accordion-toggle">
                                <th scope="row">1</th>
                                <td>John Doe</td>
                                <td><button class="btn btn-sm btn-info" type="button" type="button" data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="false" aria-controls="details1">View Details</button></td>
                              </tr>
                              <tr class="">
                                <td colspan="3" class=" p-0">
                                  <div class="collapse" id="details1">
                                    <div class="card card-body">
                                      Details for John Doe go here.
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr data-toggle="collapse" data-target="#details2" class="accordion-toggle">
                                <th scope="row">1</th>
                                <td>John Doe</td>
                                <td><button class="btn btn-sm btn-info" type="button" type="button" data-bs-toggle="collapse" data-bs-target="#details2" aria-expanded="false" aria-controls="details2">View Details</button></td>
                              </tr>
                              <tr class="">
                                <td colspan="3" class=" p-0">
                                  <div class="collapse" id="details2">
                                    <div class="card card-body">
                                      Details for John Doe go here.
                                    </div>
                                  </div>
                                </td>
                              </tr>
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
