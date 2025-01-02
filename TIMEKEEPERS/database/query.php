<?php 


namespace Timekeepers\Database;

use Timekeepers\Database\App;
require_once 'index.php';

class Query extends App{

    protected $query;
    public function select($columns = "*")
    {
        $this->query = "SELECT $columns ";
        return $this;
    }

    public function from($table)
    {
        $this->query .= "FROM $table ";
        return $this;
    }

    
    public function where($key,$value)
    {
        $this->query .= "WHERE $key = '$value' ";
        return $this;
    }

    public function orderBy($columns,$direction = 'ASC')
    {
        $this->query .= "ORDER BY $columns $direction";
        return $this;
    }
    
    
    public function get()
    {
        // var_dump($this);die;
        $result = $this->connect->query($this->query);
        return $this->fetch_object($result);
    }

    public function limit($limit)
    {
        $result = $this->connect->query($this->query." LIMIT $limit");
        return $this->fetch_object($result);
    }
}