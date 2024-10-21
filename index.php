<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>

    <main role="main" class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
                    <img class="mr-3" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-outline.svg" alt=""
                        width="48" height="48">
                    <div class="lh-100">
                        <h6 class="mb-0 text-white lh-100">Windows</h6>
                        <small>12,480</small>
                    </div>
                </div>

                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <!-- <h6 class="border-bottom border-gray pb-2 mb-0">Suggestions</h6> -->
                    <div class="media text-muted pt-3">
                        <img src="https://dummyimage.com/100x100/aaaaaa/fff" class="soft-thumb" alt="">
                        <div
                            class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray d-flex justify-content-between align-items center">
                            <div class="">
                                <a href="details.php"><strong class="text-dark">Full Name</strong></a>
                                <small class="d-block">Windows | Audio</small>
                            </div>
                            <h5 class="text-dark" href="#">1.3 Gb</h5>
                        </div>
                    </div>

                    <small class="d-block text-right mt-3">
                        <a href="#">All suggestions</a>
                    </small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar bg-light p-2 mt-3 box-shadow">
                    <h5>Most Downloaded</h5>
                    <hr>
                    <?php
                    $i = 1;
                    while ($i < 10) {
                    ?>
                    <div class="media text-muted pt-3">
                        <img src="https://picsum.photos/40/40?random=<?php echo $i ?>" class="soft-thumb" alt="">
                        <div
                            class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray d-flex justify-content-between align-items center">
                            <div class="">
                                <strong class="text-dark">Full Name</strong>
                                <small class="d-block">Windows | Audio</small>
                            </div>
                            <h6 class="text-dark" href="#"><?php echo $i ?>.3 Gb</h6>
                        </div>
                    </div>
                    <?php $i++;
                    } ?>

                </div>
            </div>
        </div>

    </main>

    <?php require_once('parts/footer.php'); ?>