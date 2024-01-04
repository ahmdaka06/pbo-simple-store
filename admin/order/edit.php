<?php
require '../../connect.php';

// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
}

// get parameter id
if (isset($_GET['id']) AND is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // check with query where by id
    $check_order = $database->query("
    SELECT orders.*, users.name AS u_name, product.name AS product_name, product.price, product.img AS product_img 
    FROM orders, product, users 
    WHERE orders.product_id = product.id AND orders.user_id = users.id AND orders.id = $id 
    LIMIT 1");

    // if data is null 
    if ($check_order->num_rows == 0) {
        http_response_code(404);
        die('not found');
    }

    // set data with fetching
    $order = $check_order->fetch_assoc();
} else {
    http_response_code(404);
    die('not found');
}
if (isset($_POST['submit'])) {
    $status = $_POST['status'];

    // query update
    $update = $database->query("UPDATE `orders` SET `status`='$status',`updated_at`='$datetime' WHERE `id` = $id");
    if ($update) { // if success update
        alert('Berhasil mengubah pesanan');
        redirect('admin/order/list.php');
    } else {
        alert('Gagal mengubah pesanan');
        redirect('admin/order/list.php');
    }

}
include '../../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12 my-2">
        <a href="<?= $base_url . 'admin/product/list.php' ?>" class="btn btn-warning btn-md">Kembali</a>
    </div>
    <div class="col-md-8 mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Pesanan #<?= $order['invoice'] ?></h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                            <img class="img-thumbnail" src="<?= $base_url ?>assets/product/<?= $order['product_img'] ?>" alt="<?= $order['product_name'] ?>" height="200px" width="200px">
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nama Pembeli</label>
                            <input type="text" class="form-control" name="u_name" id="u_name" value="<?= $order['u_name'] ?>" readonly>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $order['product_name'] ?>" readonly>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?= $order['price'] ?>" readonly>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Alamat Lengkap</label>
                            <textarea type="number" class="form-control" name="address" id="address" cols="5" rows="5" readonly><?= $order['address'] ?></textarea>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control form-select">
                                <?php foreach ($config['status']['orders'] as $key => $value) { ?>
                                    <option value="<?= $value ?>" <?= ($value == $order['status']) ? 'selected' : '' ?>> <?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <button type="submit" class="btn btn-success" name="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on("click", ".select-img", function() {
var file = $(this).parents().find(".img");
    file.trigger("click");
});

$('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#img").val(fileName);
    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
</script>
<?php 
include '../../layouts/footer.php';
?>