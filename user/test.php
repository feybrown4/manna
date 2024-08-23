<?php
// Database connection
$con = new mysqli("localhost", "username", "password", "database");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch categories
$sql = "SELECT * FROM category WHERE active = 'Yes' AND feature = 'Yes' ORDER BY RAND() LIMIT 6";
$res = mysqli_query($con, $sql);
$categories = [];
while ($row = mysqli_fetch_assoc($res)) {
    $categories[] = $row;
}
?>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Our Products</h1>
                    <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
            </div>
            <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <?php foreach ($categories as $index => $category) : ?>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 <?= $index === 0 ? 'active' : '' ?>" data-bs-toggle="pill" href="#tab-<?= $index + 1 ?>">
                                <?= htmlspecialchars($category['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <?php foreach ($categories as $index => $category) : ?>
                <div id="tab-<?= $index + 1 ?>" class="tab-pane fade show p-0 <?= $index === 0 ? 'active' : '' ?>">
                    <div class="row g-4">
                        <?php
                        // Fetch products for the current category
                        $category_id = $category['id'];
                        $productSql = "SELECT * FROM product WHERE category_id = $category_id AND active = 'Yes' ORDER BY RAND() LIMIT 4";
                        $productRes = mysqli_query($con, $productSql);
                        while ($product = mysqli_fetch_assoc($productRes)) :
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product-item">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-fluid w-100" src="img/product-<?= $product['id'] ?>.jpg" alt="">
                                        <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                                    </div>
                                    <div class="text-center p-4">
                                        <a class="d-block h5 mb-2" href=""><?= htmlspecialchars($product['title']) ?></a>
                                        <span class="text-primary me-1">$<?= htmlspecialchars($product['price']) ?></span>
                                        <span class="text-body text-decoration-line-through">$<?= htmlspecialchars($product['old_price']) ?></span>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="w-50 text-center border-end py-2">
                                            <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                                        </small>
                                        <small class="w-50 text-center py-2">
                                            <a class="text-body" href=""><i class="fa fa-shopping-bag text-primary me-2"></i>Add to cart</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <div class="col-12 text-center">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="">Browse More Products</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
// Close the connection
mysqli_close($con);
?>
