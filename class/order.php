<?php

class Order {

    private $db; // set private property db

    // method construct
    public function __construct($db) {
        $this->db = $db; // set property db
    }

    // method insert order
    public function insertOrder($user_id, $product_id, $invoice, $address, $datetime) {
        return $this->db->query("INSERT INTO `orders`(`user_id`, `product_id`, `invoice`, `address`, `created_at`) VALUES ('$user_id','$product_id','$invoice','$address','$datetime')");
    }

    // method get order by user id
    public function getOrderByUserId($user_id) {
        return $this->db->query("SELECT * FROM orders INNER JOIN product ON orders.product_id = product.id WHERE orders.user_id = '$user_id'");
    }

}