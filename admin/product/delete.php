<?php
require '../../connect.php';
// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // check with query where by id
    $check_product = $database->query("SELECT * FROM product WHERE `id` = $id LIMIT 1");

    // if data is null 
    if ($check_product->num_rows == 0) {
        http_response_code(404);
        die('not found');
    }

    $product = $check_product->fetch_assoc(); // fetch data product
    $dir = $config['app']['path'] . 'assets/product/'; // set directory img product

    $delete = $database->query("DELETE FROM product WHERE id = $id");
    if ($delete) { // if success update
        if (file_exists($dir . $product['img'])) { // delete old image
            unlink($dir . $product['img']);
        }
        alert('Berhasil menghapus produk');
        redirect('admin/product/list.php');
    } else {
        alert('Gagal menghapus produk');
        redirect('admin/product/list.php');
    }
}