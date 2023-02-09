<?php
    class UserController{
        protected $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function getUserById($id){
            $sql = "SELECT * FROM `users`";
            $users = $this->db->select($sql);
            $found = [];
            
            foreach($users as $user){
                if($user['id'] == $id){
                    $found = $user;
                }
            }

            return $found;
        }
    }
