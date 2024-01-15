<?php
require 'connect.php';

// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_customer'])) {
    redirect('logout.php');
}

// get parameter product_id
if (isset($_GET['product_id']) AND is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // check with query where by product_id
    $check_product = $database->query("SELECT * FROM product WHERE `id` = $product_id LIMIT 1");

    // if data is null 
    if ($check_product->num_rows == 0) {
        http_response_code(404);
        die('not found');
    }

    // set data with fetching
    $product = $check_product->fetch_assoc();
} else {
    http_response_code(404);
    die('not found');
}
if (isset($_POST['submit'])) {
    $address = $_POST['address'];
    $user_id = $_SESSION['user']['id']; // get user id from user id
    $invoice = time(); // generate invoice 
    
    // insert order with method insertOrder from class order
    $insert_order = $orderClass->insertOrder($user_id, $product_id, $invoice, $address, $datetime);

    if ($insert_order) { // if success insert order
        alert('Berhasil melakukan pesanan');
        redirect('history.php');
    } else {
        alert('Gagal melakukan pesanan');
        redirect('history.php');
    }

}
include 'layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12 my-2">
        <a href="<?= $base_url . 'index.php' ?>" class="btn btn-warning btn-md">Kembali</a>
    </div>
    <div class="col-md-8 mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> <?= $product['name'] ?></h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <img class="img-thumbnail" src="<?= $base_url ?>assets/product/<?= $product['img'] ?>" alt="<?= $product['name'] ?>" height="200px" width="200px">
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $product['name'] ?>" readonly>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?= $product['price'] ?>" readonly>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Alamat Lengkap</label>
                            <textarea type="number" class="form-control" name="address" id="address" cols="5" rows="5"></textarea>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <button type="submit" class="btn btn-success" name="submit">
                                Beli
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<?php 
include 'layouts/footer.php';
?>