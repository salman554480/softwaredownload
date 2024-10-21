<?php require_once('parts/top.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>
    <div class="bar">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h4>Software Name</h4>

                <div class="breadcrumbs">
                    <a href="">Home</a> <i class="fas fa-chevron-right"></i>
                    <a href="">Windows</a> <i class="fas fa-chevron-right"></i>
                    <a href="">Category</a>
                </div>

            </div>
        </div>
    </div>

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <h2>Name Here</h2>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="owl-carousel my-3">
                        <div class="item"><img src="https://picsum.photos/600/300?random=1" alt="Image 1"></div>
                        <div class="item"><img src="https://picsum.photos/600/300?random=1" alt="Image 2"></div>
                        <div class="item"><img src="https://picsum.photos/600/300?random=1" alt="Image 3"></div>
                        <!-- Add more images as needed -->
                    </div>

                    <!-- Description -->
                    <div class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat incidunt
                        delectus voluptate
                        magni pariatur cupiditate molestiae, magnam dolores voluptates sint expedita. Voluptas, quae
                        illum. Qui, ipsa. Ipsum ex repellendus quibusdam.</div>

                </div>

                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <h4>Previous Version</h4>
                    <div class="container mt-5">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th> Date</th>
                                    <th>Name</th>
                                    <th>Version</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1.0.0</td>
                                    <td>January 1, 2020</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Download</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>1.1.0</td>
                                    <td>March 15, 2020</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Download</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>1.2.0</td>
                                    <td>June 30, 2020</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Download</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2.0.0</td>
                                    <td>October 5, 2021</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Download</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>

            </div>
            <script>
            $(document).ready(function() {
                $(".owl-carousel").owlCarousel({
                    items: 1,
                    loop: true,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true
                });
            });
            </script>
            <div class="col-md-3">
                <div class="sidebar bg-light p-3 mt-3 box-shadow">
                    <div class="size-area d-flex justify-content-center align-items-center">
                        <span class="size-text">17.3 <span class="size-meter">GB</span></span>
                    </div>
                    <a href="#" class="btn btn-success btn-block"><i class="fas fa-download"></i> Download</a>
                </div>

                <div class="sidebar bg-light p-3 mt-3 box-shadow">
                    <h5>Product Information</h5>
                    <br>
                    <div class="d-flex justify-content-between mb-3 stat-area">
                        <p class="meta-stats">File name</p>
                        <p class="meta-stats">Microsoft</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3 stat-area">
                        <p class="meta-stats">Publisher</p>
                        <p class="meta-stats">Microsoft</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3 stat-area">
                        <p class="meta-stats">Version</p>
                        <p class="meta-stats">2409 Build 18025.20160</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3 stat-area">
                        <p class="meta-stats">Release Date</p>
                        <p class="meta-stats">October 17, 2024</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3 stat-area">
                        <p class="meta-stats">Total Downloads</p>
                        <p class="meta-stats">546523</p>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <?php require_once('parts/footer.php'); ?>