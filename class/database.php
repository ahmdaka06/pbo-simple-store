<?php

class Database {

    protected $conn;

    public function __construct($host, $user, $password, $database)
    {
        // try catch
        try {
            $this->conn = mysqli_connect($host, $user, $password, $database);

            if ($this->conn->errno) {
                die("Kesalahan Pada Server" . $this->conn->errno);
            }
        } catch (mysqli_sql_exception $e) { // catch mysqli exception
            if ($e->getCode() == 1049) { // check exception code
                redirect('not-install.php'); // redirect to not-install.php
            } else {
                die("Kesalahan Pada Server" . $e->getMessage());
            }
           
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