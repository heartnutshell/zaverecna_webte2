<?php

require_once __DIR__ . "/../../config.php";

class Database
{
    private $conn;

    /**
     * Database constructor.
     * @param $conn
     */
    public function __construct()
    {
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            $this->conn->exec("set names utf8");
        }catch (PDOException $exception){
            echo "Database could not be connected: ".$exception->getMessage();
        }
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(){

        return $this->conn;

    }


}
?>