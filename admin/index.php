<?php
require '../connect.php';
// check if hasn't session admin redirect to login
if (!isset($_SESSION['is_admin'])) {
    redirect('admin/logout.php');
}
redirect('admin/dashboard.php');