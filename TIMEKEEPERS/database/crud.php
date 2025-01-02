<?php


namespace Timekeepers\Database;

require_once 'query.php';
use Timekeepers\Database\App;

class Crud extends App {

    protected $table;
    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }
    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO ".$this->table." ($columns) VALUES ($values)";
        $this->connect->query($query);
    }

    public function update($data,$id)
    {
        $set = '';
        foreach ($data as $column => $value) {
            $set .= "$column = '$value', ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE ".$this->table." SET $set WHERE id = $id";
        $this->connect->query($query);
        // $this->connect->query($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM ".$this->table." WHERE id = $id";
        $this->connect->query($query);
    }
}