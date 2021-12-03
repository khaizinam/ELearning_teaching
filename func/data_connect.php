<?php
          class DataBase  
        {
              public $host='localhost';
              public $name='root';
              public $pass='';
              public $database='elearning_v2';
      
              public $link;
              public $eror;
              public  function __construct()
              {
                  $this->connectDB();
              }
              public function connectDB(){
                      $this->link = new mysqli($this->host,$this->name,$this->pass,$this->database);
                      if (!$this->link) {
                          $this->eror = "Connect fail".$this->link->connect_error;
                          return false;
                      }
              }
              public function send($query){
                 $result = $this->link->query($query);
                return $result;
              }
        }  
        class Department {
                public $db;
       
               public function __construct()
               {
                   $this->db = new DataBase();
               }
               public function select(){
                   $query = "SELECT * FROM department";
                   $result=$this->db->send($query);
                   return $result;
               } 
                public function insert($name){
                    $query = "INSERT INTO department(name) VALUES ('".$name."')";
                    $result=$this->db->send($query);
                    if($result == true){
                        $mes = 'Insert success new Department';
                    
                    }else {
                        $mes = 'Insert fail new Department';
                    }
                    return $mes;
                } 
                public function update($name,$id){
                    $query = "UPDATE department SET name = '".$name."' WHERE ID = '".$id."'";
                    $result=$this->db->send($query);
                    if($result == true){
                        $mes = 'Update success Department';
                    
                    }else {
                        $mes = 'Update fail Department';
                    }
                    return $mes;
                } 
        }
        
        class Lecturer {
            public $db;
       
               public function __construct()
               {
                   $this->db = new DataBase();
               }
               public function select(){
                   $query = "SELECT lecturer.f_name as lecturerfName,lecturer.l_name as lecturerlName, lecturer.ID as lecturerID, department.name as DepartmentName , department.ID as DepartmentID  
                   FROM lecturer
                   INNER JOIN department ON lecturer.departmentID = department.ID ORDER BY lecturer.l_name ASC";
                   $result=$this->db->send($query);
                   return $result;
               } 
            public function select_id($id){
                    $query = "SELECT lecturer.f_name as lecturerfName,lecturer.l_name as lecturerlName, lecturer.ID as lecturerID, department.name as DepartmentName , department.ID as DepartmentID  
                    FROM lecturer
                    INNER JOIN department ON lecturer.departmentID = department.ID
                    WHERE lecturer.ID = '".$id."'";
                    $result=$this->db->send($query);
                    return $result;
            } 
            public function insert($id,$fname,$lname,$departmentid){
                $query = "INSERT INTO lecturer(ID, f_name, l_name, DepartmentID) VALUES ('".$id."', '".$fname."','".$lname."', '".$departmentid."')";
                $result=$this->db->send($query);
                if($result == true){
                    $mes = 'Insert success new Lecturer';
                
                }else {
                    $mes = 'Insert fail new Lecturer';
                }
                return $mes;
            } 
            public function update($id,$fname,$lname,$departmentid){
                $query = "UPDATE lecturer SET f_name = '".$fname."',l_name = '".$lname."',DepartmentID = '".$departmentid."' WHERE ID = '".$id."'";
                $result=$this->db->send($query);
                if($result == true){
                    $mes = 'Update success Lecturer';
                
                }else {
                    $mes = 'Update fail Lecturer';
                }
                return $mes;
            } 
        }
        class Student{
            public $db;
       
               public function __construct()
               {
                   $this->db = new DataBase();
               }
               public function select(){
                   $query = "SELECT pupil.f_name as studentfName,pupil.l_name as studentlName, pupil.ID as studentID, pupil.status as status, department.name as DepartmentName , department.ID as DepartmentID  
                   FROM pupil
                   INNER JOIN department ON pupil.departmentID = department.ID ORDER BY pupil.l_name ASC";
                   $result=$this->db->send($query);
                   return $result;
               } 
               public function insert($id,$fname,$lname,$departmentid,$status){
                    $query = "INSERT INTO pupil(ID, f_name, l_name,status, DepartmentID) VALUES ('".$id."', '".$fname."','".$lname."', '".$status."', '".$departmentid."')";
                    $result=$this->db->send($query);
                    if($result == true){
                        $mes = 'Insert success new Student';
                    
                    }else {
                        $mes = 'Insert fail new Student';
                    }
                    return $mes;
                }
                public function select_id($id){
                    $query = "SELECT pupil.f_name as studentfName,pupil.l_name as studentlName, pupil.ID as studentID, pupil.status as status, department.name as DepartmentName , department.ID as DepartmentID  
                    FROM pupil
                    INNER JOIN department ON pupil.departmentID = department.ID WHERE pupil.ID = '".$id."'";
                    $result=$this->db->send($query);
                    return $result;
                } 
                public function update($id,$fname,$lname,$departmentid,$status){
                    $query = "UPDATE pupil SET f_name = '".$fname."',l_name = '".$lname."',DepartmentID = '".$departmentid."',status = '".$status."' WHERE ID = '".$id."'";
                    $result=$this->db->send($query);
                    if($result == true){
                        $mes = 'Update success student';
                    
                    }else {
                        $mes = 'Update fail student';
                    }
                    return $mes;
                }   
        }
        class Subject{
            public $db;
       
               public function __construct()
               {
                   $this->db = new DataBase();
               }
               public function select(){
                   $query = "SELECT * FROM subject";
                   $result=$this->db->send($query);
                   return $result;
               } 
            public function insert($id,$name,$credits){
                $query = "INSERT INTO subject(ID,name,credits) VALUES ('".$id."', '".$name."','".$credits."')";
                $result=$this->db->send($query);
                if($result == true){
                    $mes = 'Insert success new Subject';
                
                }else {
                    $mes = 'Insert fail new Subject';
                }
                return $mes;
            }
        }



       
?>