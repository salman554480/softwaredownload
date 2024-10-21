<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Offcanvas navbar</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Windows</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Mac</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Android Apps</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Android Games</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-truncate" href="#">Switch account</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Settings</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
        </ul>
        <form class="form-inline my-2 my-lg-0 text-nowrap">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="nav-scroller bg-white box-shadow">
    <nav class="nav nav-underline">
        <a class="nav-link active" href="#">Categories</a>
        <?php
        require_once('parts/db.php');
        $select_category = "SELECT * from category";
        $result_category = mysqli_query($conn, $select_category);
        while ($row_category =  mysqli_fetch_array($result_category)) {
            $category_id = $row_category['category_id'];
            $category_name = $row_category['category_name'];
        ?>
        <a class="nav-link" href="#"><?php echo $category_name; ?></a>
        <?php } ?>
    </nav>
</div>