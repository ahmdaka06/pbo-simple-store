<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><?= $config['app']['name'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <?php
                // check session admin
                if (isset($_SESSION['is_admin']) AND $_SESSION['is_admin'] == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>admin/dashboard.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>admin/product/list.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>admin/order/list.php">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>admin/logout.php">Logout</a>
                    </li>
                    <?php
                // check session admin
                } elseif (isset($_SESSION['is_customer']) AND $_SESSION['is_customer'] == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>index.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>history.php">Riwayat Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>">Halaman Utama</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>admin/login.php">Login Admin</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $base_url ?>login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>