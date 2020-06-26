<?php

namespace classes;

use classes\Db;

class Model {

    protected $db;
    public $sql;

    public function __construct()
    {
        $this->db = new Db();
    }
    public function all()
    {
        if (!$this->sql) {
            $result = $this->db->query("SELECT * FROM $this->tableName");
        } else {
            $result = $this->db->query($this->sql);
        }
        $arr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
        }
        if (empty($arr)) {
            $this->sql = null ;
            return false;
        } else {
            $this->sql = null ;
            return $arr;
        }
    }
    public function select($str = "*")
    {
        $this->sql = "SELECT $str FROM $this->tableName ";
        return $this;
    }
    public function where($arr)
    {
        $this->sql .= "WHERE ";
        $conter = 0;
        foreach ($arr as $key => $value) {
            $key = $this->db->escape($key);
            $value = $this->db->escape($value);
            if ($counter == 0) {
                $this->sql .= "$key = '$value' ";
                $counter++;
            } else {
                $this->sql .= "AND ";
                $this->sql .= "$key = '$value' ";
            }
        }
        return $this;
    }
    public function insert($arr)
    {
        $this->sql = "INSERT INTO $this->tableName  ";
        $keys = '( ';
        $values = '( ';
        $counter = 0;
        foreach ($arr as $key => $value) {
            $key = $this->db->escape($key);
            $value = $this->db->escape($value);
            if ($counter == 0) {
                $keys .= "$key";
                $values .= "'$value'";
                $counter++;
            } else {
                $keys .= ", $key";
                $values .= ", '$value'";
            }
        }
        $keys .= " ) ";
        $values .= " ) ";
        $this->sql .= "$keys VALUES $values";
        // return $this->sql;
        $result = $this->db->query($this->sql);
        $this->sql = null;
        return $result;
    }
    public function delete($arr)
    {
        $this->sql = "DELETE FROM $this->tableName WHERE ";
        
        foreach ($arr as $key => $value) {
            $key = $this->db->escape($key);
            $value = $this->db->escape($value);
            $this->sql .= "$key = '$value' ";
        }

        $result = $this->db->query($this->sql);
        $this->sql = null;
        return $result;
    }
    public function update($arr)
    {
        $this->sql = "UPDATE $this->tableName SET ";
        $counter = 0;
        foreach ($arr as $key => $value) {
            $key = $this->db->escape($key);
            $value = $this->db->escape($value);
            if ($counter === 0) {
                $this->sql .= "$key = '$value' ";   
                $counter++;
            } else {
                $this->sql .= ", $key = '$value' ";   
            }
        }
        return $this;
    }
    public function query()
    {
        $result = $this->db->query($this->sql);
        $this->sql = null;
        return $result;
    }
}
