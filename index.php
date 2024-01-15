<?php
require 'connect.php';

include 'layouts/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="bg-body-tertiary p-5 rounded">
            <h1>Simple Store With PHP Native</h1>
            <p class="lead">Jangan lupa checkout yaaa.</p>
        </div>
    </div>
</div>
<hr>
<div class="row justify-content-center">
    <?php
    // query product
    $products = $productClass->getAll();

    // loop
    while($product = $products->fetch_assoc()) {
    ?>
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="<?= $base_url . 'assets/product/' . $product['img'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
            <div class="card-body">
                <h5 class="text-primary"><?= $product['name'] ?></h5>
                <p class="card-text">Rp <?= $product['price'] ?></p>
            </div>
            <div class="card-footer text-center">
                <a class="btn btn-success" href="<?= $base_url ?>order.php?product_id=<?= $product['id'] ?>"> Beli </a>
            </div>
        </div>
    </div>
    <?php  } ?>
</div>
<?php 
include 'layouts/footer.php';
?>