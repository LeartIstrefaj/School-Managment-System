<?php
    class UserController{
        protected $db;

        public function __construct($db){
            $this->db = $db;
        }

        private function fields($columns){
            $fields = '';
            $counter = 0;
            foreach($columns as $column => $value){
                if($counter == count($columns)-1){
                    $fields .= "`".$column."` = '".$value."'";
                }
                else{
                    $fields .= "`".$column."` = '".$value."', ";
                }
                $counter++;
                
            }
            return $fields;
        }
        public function get($role){
            $sql = "SELECT * FROM users WHERE role = '".$role."'";
            $users = $this->db->select($sql);
            return $users;
        }
        public function update($id,$columns){
            $sql = "UPDATE `users` SET ".$this->fields($columns)." WHERE `role` = ? AND `id` = ?";
            $this->db->query($sql,['student', $id]);

        }
        public function delete($id){
            $sql = "DELETE FROM `users` WHERE `role` = ? AND `id` = ?";
            $this->db->query($sql,['student', $id]);

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
