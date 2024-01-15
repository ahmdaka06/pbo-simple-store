<?php

class Product {

    private $db; // set private property db

    // method construct
    public function __construct($db) {
        $this->db = $db; // set property db
    }

    // method get all product
    public function getAll() {
        $query = "SELECT * FROM product ORDER BY id DESC"; // set query
        $products = $this->db->query($query); // run query
        return $products; // return result
    }

    // method get product by id
    public function getById($id) {
        $query = "SELECT * FROM product WHERE id = $id"; // set query
        $product = $this->db->query($query); // run query
        return $product; // return result
    }
}