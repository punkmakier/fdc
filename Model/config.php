<?php
    require_once("../Controller/global.php");

    class config{
        
        private $server = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        private $user = "root";
        private $pass = "";

        private $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        protected $con;
        public function openConnection(){
            try{
                $this->con = new PDO($this->server, $this->user,$this->pass,$this->option);
            }catch(PDOException $e){
                echo "There is some problem in the connection :". $e->getMessage();
            }

            return $this->con;
        }

        public function closeConnection(){
            $this->con = null;
        }

        
    }

?>