<?php
require '../connect.php';

session_destroy();

redirect('admin/login.php');
alert('Login berhasil!.');