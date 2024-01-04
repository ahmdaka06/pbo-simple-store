<?php
require '../../connect.php';
// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
}
include '../../layouts/header.php';
?>

<div class="row">
    <div class="col-md-12 my-2">
        <a href="<?= $base_url . 'admin/product/add.php' ?>" class="btn btn-success btn-md">Tambah</a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> List produk</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nama</td>
                                <td>Harga</td>
                                <td>Gambar</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        // query product 
                        $query_product = $database->query("SELECT * FROM product ORDER BY id DESC");
                        while ($product = $query_product->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td>Rp <?= $product['price'] ?></td>
                                <td>
                                    <img src="<?= $base_url . 'assets/product/' . $product['img'] ?>" alt="" height="80px"
                                        width="80px">
                                </td>
                                <td>
                                    <a href="<?= $base_url . 'admin/product/edit.php?id=' . $product['id'] ?>"
                                        class="badge bg-warning"> Edit</a>
                                    <a href="<?= $base_url . 'admin/product/delete.php?id=' . $product['id'] ?>"
                                        class="badge bg-danger"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../../layouts/footer.php';
?>