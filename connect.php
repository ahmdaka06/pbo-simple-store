<?php
date_default_timezone_set('Asia/Jakarta'); // set default time zone
if (!isset($_SESSION)) session_start(); // check session is initialized or not

$base_url = 'http://localhost/pbo-simple-store/'; // set base url project

$config = []; // set config to array

// set config array value
$config['db'] = [
    'host' => 'localhost', // host database
    'user' => 'root', // username database
    'password' => '', // password database
    'database' => 'simple_store_native_v2' // name database
];
$config['app']['name'] = 'Simple Store Native';
$config['app']['url'] = $base_url;
$config['app']['path'] = $_SERVER['DOCUMENT_ROOT'] . '/pbo-simple-store/'; // set root folder location

// config contact
$config['contact'] = [
    'whatsapp' => '6281335905'
];

// config payment
$config['payment'] = [
    'BRI 23295011 A/N Maulana Basyar'
];

// config status
$config['status'] = [
    'orders' => [
        'BELUM DI BAYAR',
        'SUDAH DI BAYAR',
        'PROSES PENGIRIMAN',
        'SUDAH SAMPAI'
    ]
];

$datetime = date('Y-m-d');
$date = date('Y-m-d');
$time = date('H:i:s');

require_once 'class/database.php'; // include class database
 
$database = new Database($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']); // create object database

// include class product
require_once 'class/product.php';
$productClass = new Product($database); // create object product

// include class user
require_once 'class/user.php';
$userClass = new User($database); // create object user

// include class order
require_once 'class/order.php';
$orderClass = new Order($database); // create object order



function redirect($path = '', $time = 0) {
    global $base_url; // set $base_url in global
    print '<meta http-equiv="refresh" content="'.$time.';url=' . $base_url . $path . '" />';
    // header('Location: ' . $base_url . $path);
    exit;
}

function alert($msg = '')
{
    return print "
        <script>
            alert('$msg')
        </script>
    ";
}