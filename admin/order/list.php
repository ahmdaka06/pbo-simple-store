<?php
require '../../connect.php';
// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
}
include '../../layouts/header.php';
?>

<div class="row">
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
                                <td>No. Pesanan</td>
                                <td>Nama Pembeli</td>
                                <td>Nama Produk</td>
                                <td>Harga Produk</td>
                                <td>Alamat Pembeli</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        // query product 
                        $no = 1;
                        $query_order = $database->query("
                            SELECT orders.*, users.name AS u_name, product.name AS product_name, product.price AS product_price 
                            FROM orders, product, users 
                            WHERE orders.product_id = product.id AND orders.user_id = users.id 
                            ORDER BY orders.id DESC");
                        while ($order = $query_order->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $order['invoice'] ?></td>
                                <td><?= $order['u_name'] ?></td>
                                <td><?= $order['product_name'] ?></td>
                                <td>Rp <?= $order['product_price'] ?></td>
                                <td><?= $order['address'] ?></td>
                                <td><?= $order['status'] ?></td>
                                <td>
                                    <a href="<?= $base_url . 'admin/order/edit.php?id=' . $order['id'] ?>"
                                        class="badge bg-warning"> Edit</a>
                                    <a href="<?= $base_url . 'admin/order/delete.php?id=' . $order['id'] ?>"
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