<?php 

class db {
    private $host = 'localhost';
    private $dbName = 'login_system';
    private $user = 'root';
    private $pass = '';

    public function connect(){
        $conn = new PDO('mysql:host='. $this->host.'; dbname='.$this->dbName,
        $this->user,$this->pass);

        return $conn;

    }
}