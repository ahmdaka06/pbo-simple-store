<?php
require '../../connect.php';

// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
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

    if (in_array($ext, $permission_ext) === true){
        //Mengupload gambar
        $set_img_name = md5($image . time()) . '.' . $ext; // set and generate image name with hash md5
        if (move_uploaded_file($file_tmp, $dir . $set_img_name)) {
            // query insert produvt
            $insert = $database->query("INSERT INTO `product`(`id`, `name`, `price`, `img`) VALUES (null, '$name', '$price','$set_img_name')");
            if ($insert) { // if success insert
                alert('Berhasil menambahkan product');
                redirect('admin/product/list.php');
            } else {
                alert('Gagal menambahkan product');
                redirect('admin/product/list.php');
            }
        } else {
            alert('Gagal upload gambar');
            
        }

        
    } else {
        alert('Eksitensi file tidak di perbolehkan!.');
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
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="price" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Gambar Produk</label>
                            <div class="input-group mb-3 w-100">
                                <input type="file" name="img" class="img"  style="visibility: hidden; position:absolute">
                                <input type="text" disabled class="form-control" id="img" placeholder="Upload Gambar">
                                <button class="browse btn btn-outline-secondary select-img" type="button" id="button-addon2">Upload</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <img src="<?= $base_url . 'assets/dummy.png' ?>" class="img-thumbnail" alt="dummy image" id="preview" height="200px" width="200px">
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