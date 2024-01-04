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
    $check_product = $database->query("SELECT * FROM product WHERE `id` = $id LIMIT 1");

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
    $name = $_POST['name'];
    $price = $_POST['price'];

    $permission_ext	= array('png','jpg','svg','webp','jpeg'); // eksitensi yg di perbolehkan
    $image = $_FILES['img']['name']; // get image name
    $explode_img = explode('.', $image);
    $ext = strtolower(end($explode_img)); // get eksitensi
    $file_tmp = $_FILES['img']['tmp_name'];
    $dir = $config['app']['path'] . 'assets/product/'; // set directory

    $set_img_name = $product['img'];
    
    if (isset($_FILES['img']['name']) AND !empty($_FILES['img']['name'])) {
        if (in_array($ext, $permission_ext) === true){
            // upload image
            $set_img_name = md5($image . time()) . '.' . $ext; // set and generate image name with hash md5
            $upload = move_uploaded_file($file_tmp, $dir . $set_img_name); // upload image
            if (!$upload) { // check if upload is error
                alert('Gagal upload gambar');
            }
            if (file_exists($dir . $product['img'])) { // delete old image
                unlink($dir . $product['img']);
            }
        } else {
            alert('Eksitensi file tidak di perbolehkan!.');
        }
    }
    // query update
    $update = $database->query("UPDATE `product` SET `name`='$name',`price`='$price',`img`='$set_img_name',`updated_at`='$datetime' WHERE `id` = $id");
    if ($update) { // if success update
        alert('Berhasil mengubah produk');
        redirect('admin/product/list.php');
    } else {
        alert('Gagal mengubah produk');
        redirect('admin/product/list.php');
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
                <h5 class="card-title"> Tambah Produk</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $product['name'] ?>" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?= $product['price'] ?>" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Gambar Produk</label>
                            <div class="input-group mb-3 w-100">
                                <input type="file" name="img" class="img"  style="visibility: hidden; position:absolute">
                                <input type="text" disabled class="form-control" id="img" placeholder="Upload Gambar">
                                <button class="browse btn btn-outline-secondary select-img" type="button" id="button-addon2">Upload</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <img src="<?= $base_url . 'assets/product/' . $product['img'] ?>" class="img-thumbnail" alt="dummy image" id="preview" height="200px" width="200px">
                            </div>
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