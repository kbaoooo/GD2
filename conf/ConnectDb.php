<?php 

class Connect {
    const HOST = "localhost";
    const DBNAME = "gd2";

    const DBUSER = "root";

    const PASSWORD = "";

    protected $conn = NULL;
    
    public function __construct() {
        $dns = 'mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8mb4';
        $this->conn = new PDO($dns, self::DBUSER, self::PASSWORD);
        if($this->conn) {
        } else {
            throw new Exception("Error");
        }
    }
}