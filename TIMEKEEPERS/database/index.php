<?php

namespace Timekeepers\Database;
session_start();

class App {
    protected $connect;
    public function __construct()
    {
        $this->connect = new \mysqli('localhost','root','','timekeepers');
        
    }

    public function fetch_object($query)
    {
        $data = [];
        while ($row = $query->fetch_object()) {
            $data[] = $row;
        }
        
        return $data;
    }
}
