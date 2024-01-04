<?php
require '../connect.php';
// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
}
include '../layouts/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="bg-body-tertiary p-5 rounded">
            <h1>Halo, <?= $_SESSION['user']['name'] ?></h1>
            <p class="lead"> Selamat datang di halaman admin.</p>
        </div>
    </div>
</div>
<?php 
include '../layouts/footer.php';
?>