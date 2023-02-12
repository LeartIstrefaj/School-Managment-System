<?php
   
    class Database{
        protected $host;
        protected $user;
        protected $password;
        protected $pdo;

        public function __construct($host,$user,$password){
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->pdo = new PDO($this->host,$this->user,$this->password);
        }
        public function query($sql, $values){
            $stm = $this->pdo->prepare($sql);
            $stm->execute($values);
            echo "Done!";
        }
        public function select($sql){
            $query = $this->pdo->query($sql);
            $users = [];

            while($row = $query->fetch()){
                 $users[] = $row;
            }

            return $users;
        }
       
    }