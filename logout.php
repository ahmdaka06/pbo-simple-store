<?php
require 'connect.php';

session_destroy();

redirect('login.php');
alert('Login berhasil!.');