<?php

class CRUD{
    
    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    private function fields($columns,$sep= ','){
        $fields = '';
        $counter = 0;
        foreach($columns as $column => $value){
            if($counter == count($columns) -1){
                $fields .= "`".$column."` = ?";
            }
            else{
                $fields .= "`".$column."` = ?" .$sep;
            }
            $counter++;
            
        }
        return $fields;
    }
    private function where($columns,$sep = 'AND'){
        $fields = '';
        $counter = 0;
        foreach($columns as $column => $value){
            if($counter == count($columns)-1){
                $fields .= "`".$column."` = '".$value."'";
            }
            else{
                $fields .= "`".$column."` = '".$value."'". $sep." ";
            }
            $counter++;
            
        }
        return $fields;
    }

    public function create($table,$columns = []){
        $sql = "INSERT INTO `".$table."` SET " .$this->fields($columns);
        return $this->db->query($sql,array_values($columns));
    }
    
    public function read($table,$conditions=[]){
        $sql = "SELECT * FROM `".$table."`";

        if (count($conditions) > 0) { 
            $sql = "SELECT * FROM `".$table."` WHERE " .$this->where($conditions);
        }
        $results = $this->db->select($sql);
        return $results;
    }
    
    

    public function update($table,$columns,$conditions){
        $sql = "UPDATE `".$table."` SET" .$this->fields($columns);
        if (count($conditions) > 0){
            $sql = "UPDATE `".$table."` SET" .$this->fields($columns)." WHERE".$this->fields($conditions,"AND");
        }
        return $this->db->query($sql,array_merge(array_values($columns),array_values($conditions)));
      
    } 
    public function delete($table,$conditions){
        $sql = "DELETE FROM `".$table."`";
        if (count($conditions) > 0){
            $sql = "DELETE FROM `".$table."` WHERE".$this->fields($conditions,"AND");
        }
        return $this->db->query($sql,array_values($conditions));
        
    } 
   
//---------------------------------------------------
// class CRUD{
    
//     protected $db;

//     public function __construct($db){
//         $this->db = $db;
//     }

//     private function fields($columns, $sep = ','){
//         $fields = '';
//         $counter = 0;
//         foreach($columns as $column => $value){
//             if($counter == count($columns) - 1){
//                 $fields .= "`".$column."` = ?";
//             }
//             else{
//                 $fields .= "`".$column."` = ? ".$sep." ";
//             }
//             $counter++;
//         }
//         return $fields;
//     }

//     public function create($table,$columns = []){
//         $sql = "INSERT INTO `".$table."` SET ".$this->fields($columns);
//         return $this->db->query($sql, array_values($columns));
//     }

//     public function read($table,$conditions=[]){
//         $sql = "SELECT * FROM `".$table."`";
//         if (count($conditions) > 0){
//             $sql .= " WHERE ".$this->fields($conditions, "AND");
//         }
//         return $this->db->select($sql, array_values($conditions));
//     }

//     public function update($table, $columns, $conditions = []){
//         $sql = "UPDATE `".$table."` SET ".$this->fields($columns);
//         if (count($conditions) > 0){
//             $sql .= " WHERE ".$this->fields($conditions, "AND");
//         }
//         return $this->db->query($sql, array_merge(array_values($columns), array_values($conditions)));
//     }

//     public function delete($table, $conditions = []){
//         $sql = "DELETE FROM `".$table."`";
//         if (count($conditions) > 0){
//             $sql .= " WHERE ".$this->fields($conditions, "AND");
//         }
//         return $this->db->query($sql, array_values($conditions));
//     }
}

