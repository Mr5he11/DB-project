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
            $this->host = $host_conn;
            $this->db   = $db_conn;
            $this->user = $user_conn;
            $this->pass = $psw_conn;
            $this->charset = $char_conn;
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