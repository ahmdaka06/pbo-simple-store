<?php
require 'connect.php';
// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_customer'])) {
    redirect('logout.php');
}
include 'layouts/header.php';
$user_id = $_SESSION['user']['id']; // get user id from session user
?>

<div class="row">
    <div class="col-md-12 my-3">
        <div class="alert alert-primary my-2" role="alert">
            Jika sudah membayar harap konfirmasi ke <strong>Whatsapp Admin</strong> <a href="https://wa.me/<?= $config['contact']['whatsapp'] ?>" class="alert-link" target="_blank">Klik disini</a> dengan menyertakan nomor pesanan!.
        </div>
        <div class="alert alert-warning my-2" role="alert">
            <h4 class="alert-heading">Informasi Pembayaran !</h4>
            <p>Harap transfer ke nomor rekening pembayaran di bawah ini.</p>
            <hr>
            <ul>
                <?php foreach ($config['payment'] as $key => $value) { ?>
                   <li><?= $value ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Riwayat Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>No. Pesanan</td>
                                <td>Nama Produk</td>
                                <td>Harga Produk</td>
                                <td>Alamat</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        // query product 
                        $no = 1;
                        $query_order = $orderClass->getOrderByUserId($user_id);
                        while ($order = $query_order->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $order['invoice'] ?></td>
                                <td><?= $order['name'] ?></td>
                                <td>Rp <?= $order['price'] ?></td>
                                <td>
                                    <?= $order['address'] ?>
                                </td>
                                <td>
                                    <?= $order['status'] ?>
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
include 'layouts/footer.php';
?>