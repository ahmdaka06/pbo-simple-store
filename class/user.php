<?php

class User {

    private $db; // set private property db

    // method construct
    public function __construct($db) {
        $this->db = $db; // set property db
    }

    // method login
    public function login($username = '', $role = 'customer')
    {
        // query check user
        return $this->db->query("SELECT * FROM users WHERE `username` = '$username' AND `role` = '$role' LIMIT 1");
    }

}