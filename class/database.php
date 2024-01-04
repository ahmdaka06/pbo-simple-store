<?php

class Database {

    protected $conn;

    public function __construct($host, $user, $password, $database)
    {
        $this->conn = mysqli_connect($host, $user, $password, $database);

        if ($this->conn->error) {
            die("Kesalahan Pada Server" . $this->conn->error);
        }
    }

    public function query($query = '')
    {
        return $this->conn->query($query);
    }

    public function affected_rows()
    {
        return $this->conn->affected_rows;
    }
}