<?php
namespace classes;

class Db {
    public function connect()
    {
        // $host = "localhost";
        // $name = "root";
        // $password = "root";
        // $dbname = "laycode";
        $host = "srv-pleskdb50.ps.kz";
        $name = "deveasys_laycode-admin";
        $password = "77754950qwerty";
        $dbname = "deveasys_laycode";
    
        static $connect = null;
    
        if ($connect === null) {
            $connect = mysqli_connect($host, $name, $password, $dbname);
        }
        if ($connect) {
            return $connect;
        }
        return die('База данных не подключенна');
    }
    public function escape($var)
    {
        return mysqli_real_escape_string($this->connect(), $var);
    }
    public function query($sql)
    {
         return mysqli_query($this->connect(), $sql);
    }
}