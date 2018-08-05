<?php
    class Connection{

        //database connection parameters
        private $host;
        private $db;
        private $user;
        private $pass;
        private $charset;
        private $dsn;
        private $opt;
        private $pdo;
        private static $instance = NULL;        
        
        //constructor: creates pdo object only once
        private function __construct(){

            //connection parameters assignment
            require 'psw.php';
            $this->host = '127.0.0.1';
            $this->db   = 'cinema';
            $this->user = 'root';
            $this->pass = $psw_conn;
            $this->charset = 'utf8mb4';
            $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            $this->opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            //pdo object creation
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        }

        //static function implementing singleton design pattern
        public static function getConnection(){
            if(is_null(static::$instance)){
                static::$instance = new Connection();
            }
            return static::$instance->pdo;
        }
    }
?>