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
                <h1><i class="bi bi-columns-gap"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>



        <!--<div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Monthly Sales</h3>
            <div class="ratio ratio-16x9">
              <canvas id="salesChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Support Requests</h3>
            <div class="ratio ratio-16x9 d-flex justify-content-center">
              <canvas id="supportRequestChart"></canvas>
            </div>
          </div>
        </div>
      </div>-->
    </main>
    <?php require_once('parts/footer.php'); ?>