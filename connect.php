<?php
    class Connection{

        //parametri di connessione al database
        private $host;
        private $db;
        private $user;
        private $pass;
        private $charset;
        private $dsn;
        private $opt;
        private $pdo;
        private static $instance = NULL;        
        
        //costruttore: crea la connessione solo nel caso non sia gia` stata creata in precedenza, grazie alla funzione statica `getConnection`
        //e` necessario implementare una classe che si rifa` al design pattern `singleton` per evitare di creare piu` instanze di connessione.
        private function __construct(){

            //assegnamento dei parametri di connessione
            $this->host = '127.0.0.1';
            $this->db   = 'cinema';
            $this->user = 'root';
            $this->pass = 'Malmsteen97';
            $this->charset = 'utf8mb4';
            $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            $this->opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            //creazione dell'oggetto di connessione
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        }

        //funzione statica che restituisce l'oggetto di connessione
        //e ne crea uno, nel caso non fosse ancora stato creato
        public static function getConnection(){
            if(is_null(static::$instance)){
                static::$instance = new Connection();
            }
            return static::$instance->pdo;
        }
    }
?>