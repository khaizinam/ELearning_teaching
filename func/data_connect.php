<?php
          class DataBase  
        {
              public $host='localhost';
              public $name='root';
              public $pass='';
              public $database='database';
      
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
              public function select($query){
                 $result = $this->link->query($query) or 
                 die($this->link->error.__LINE__);
                return $result;
              }
              public function insert($query){
                  $insert_row = $this->link->query($query) or 
                  die($this->link->error.__LINE__);
                      return $insert_row;
               }
               public function update($query){
                  $update_row = $this->link->query($query) or 
                  die($this->link->error.__LINE__);
               }
               public function delete($query){
                  $delete_row = $this->link->query($query) or 
                  die($this->link->error.__LINE__);
               }
        }  



          // NHOM LOP
          class Nhom_lop{
               public $db;
       
               public function __construct()
               {
                   $this->db = new DataBase();
               }
               public function select(){
                   $query = "SELECT * FROM nhom_lop";
                   $result=$this->db->select($query);
                   return $result;
               } 
               public function select_id($id){
                   $query = "SELECT * FROM nhom_lop WHERE ID='".$id."'";
                   $result=$this->db->select($query);
                   return $result;
               }
               public function select_id_MH($id){
                   $query = "SELECT * FROM nhom_lop WHERE id_monhoc='".$id."'";
                   $result=$this->db->select($query);
                   return $result;
               }
               public function insert(){
                   $id=$_POST['id'];
                   $ten=$_POST['ten'];
                   $start=$_POST['start'];
                   $end=$_POST['end'];
                   $room=$_POST['Phong_hoc'];
                   $id_giang_vien=$_POST['id_giang_vien'];
                   $id_subject=$_POST['id_mon_hoc'];
                   $query = "INSERT INTO nhom_lop VALUES ('".$id."','".$ten."','".$start."','".$end."','".$room."','".$id_giang_vien."','".$id_subject."')";
                   $this->db->select($query);
               }
               public function delete(){
                   $id =  $_GET['id_get'];
                   $query = "DELETE FROM nhom_lop WHERE ID='".$id."'";
                   $this->db->select($query);
               }
               public function update(){
                   $id_get= $_SESSION['id'];
                   $ten=$_POST['ten'];
                   $start=$_POST['start'];
                   $end=$_POST['end'];
                   $room=$_POST['Phong_hoc'];
                   $id_giang_vien=$_POST['id_giang_vien'];
                   $id_subject=$_POST['id_monhoc'];
                   $query = "UPDATE nhom_lop SET ten='".$ten."', tiet_bat_dau='".$start."', tiet_ket_thuc='".$end."', Phong_hoc='".$room."',id_giang_vien='".$id_giang_vien."', id_monhoc='".$id_subject."' WHERE ID='".$id_get."'";
                   $this->db->select($query);
               }
           };
           class Mon_Hoc{
            public $db;
            public function __construct()
            {
                $this->db = new DataBase();
            }
            public function select(){
                $sql = "SELECT * FROM mon_hoc";
                $result=$this->db->select($sql);
                return $result;
            }
            public function select_id($id){
                $sql = "SELECT * FROM mon_hoc WHERE ID='".$id."'";
                $result=$this->db->select($sql);
                return $result;
            }
            public function insert(){
                $id=$_POST['ID'];
                $name_MH=$_POST['Ten_MH'];
                $STC_MH=$_POST['So_TC'];
                $sql = "INSERT INTO mon_hoc VALUES ('".$id."','".$name_MH."','".$STC_MH."')";
                $this->db->select($sql);
            }
            public function delete(){
                $id =  $_GET['id_get'];
                $sql = "DELETE FROM mon_hoc WHERE ID='".$id."'";
                $this->db->select($sql);
            }
            public function update(){
                $id= $_SESSION['id'];
                $name=$_POST['Ten_MH'];
                $so_tc=$_POST['So_TC'];
                $sql = "UPDATE mon_hoc SET Ten_MH='".$name."', So_TC='".$so_tc."' WHERE ID='".$id."'";
                $this->db->select($sql);

            }
        }
    
    
    
        //==================================== SINH VIEN =================================== 
    
    
    
        class Sinh_Vien{
            public $db;
            public function __construct()
            {
                $this->db = new DataBase();
            }
            public function select(){
                $sql = "SELECT * FROM Sinh_Vien";
                $result=$this->db->select($sql);
                return $result;
            }
            public function select_id($id){
                $sql = "SELECT * FROM Sinh_Vien WHERE ID='".$id."'";
                $result=$this->db->select($sql);
                return $result;
            }
            public function insert(){
                $ID=$_POST['ID'];
                $name=$_POST['Ho_ten'];
                $lop=$_POST['Lop'];
                $email=$_POST['Email'];
                $TT_hoc=$_POST['TT_hoc'];
                $khoa_id=$_POST['khoa_ID'];
                $sql = "INSERT INTO Sinh_Vien VALUES ('".$ID."','".$name."','".$lop."','".$email."','".$TT_hoc."','".$khoa_id."')";
                $this->db->select($sql);
            }
            public function delete(){
                $id =  $_GET['id_get'];
                $sql = "DELETE FROM Sinh_Vien WHERE ID='".$id."'";
                $this->db->select($sql);

            }
            public function update(){
                $ID=$_SESSION['id'];
                $name=$_POST['Ho_ten'];
                $lop=$_POST['Lop'];
                $email=$_POST['Email'];
                $TT_hoc=$_POST['TT_hoc'];
                $khoa_id=$_POST['khoa_ID'];
                $sql = "UPDATE Sinh_Vien SET Ho_ten='".$name."',Lop='".$lop."',Email='".$email."',TT_hoc='".$TT_hoc."',khoa_ID='".$khoa_id."' WHERE ID='".$ID."' ";
                $this->db->select($sql);

            }
        }
        //==================================== KHOA =================================== 
    
    
    
        class khoa{
            public $db;
            public function __construct()
            {
                $this->db = new DataBase();
            }
            public function select(){
                $sql = "SELECT * FROM khoa";
                $result=$this->db->select($sql);
                return $result;
            }
            public function select_id($id){
                $sql = "SELECT * FROM khoa WHERE ID='".$id."'";
                $result=$this->db->select($sql);
                return $result;
            }
            public function insert(){
                $ID=$_POST['ID'];
                $name=$_POST['name'];
                $sql = "INSERT INTO khoa VALUES ('".$ID."','".$name."')";
                $this->db->select($sql);
            }
            public function delete(){
                $id =  $_GET['id_get'];
                $sql = "DELETE FROM khoa WHERE ID='".$id."'";
                $this->db->select($sql);
            }
            public function update(){
                $id =  $_SESSION['id'];
                $name =  $_POST['name'];
                $sql = "UPDATE khoa  SET name='".$name."' WHERE ID='".$id."'";
                $this->db->select($sql);

            }
        }
        //================================GIANG VIEN================================
        class Giang_Vien{
            public $db;
    
            public function __construct()
            {
                $this->db = new DataBase();
            }
            public function select(){
                $sql = "SELECT * FROM Giang_Vien";
                $result=$this->db->select($sql);
                return $result;
            } 
            public function select_id($id){
                $sql = "SELECT * FROM Giang_Vien WHERE ID='".$id."'";
                $result=$this->db->select($sql);
                return $result;
            }
            public function insert(){
                $id=$_POST['ID'];
                $name=$_POST['Ho_ten'];
                $email=$_POST['Email'];
                $sdt=$_POST['SDT'];
                $id_khoa=$_POST['ID_Khoa'];
                $sql = "INSERT INTO Giang_Vien VALUES ('".$id."','".$name."','".$email."','".$sdt."','".$id_khoa."')";
                $this->db->select($sql);
            }
            public function delete(){
                $id =  $_GET['id_get'];
                $sql = "DELETE FROM Giang_Vien WHERE ID='".$id."'";
                $this->db->select($sql);
            }
            public function update(){
                $id_get= $_SESSION['id'];
                $name=$_POST['Ho_ten'];
                $email=$_POST['Email'];
                $sdt=$_POST['SDT'];
                $id_khoa=$_POST['ID_Khoa'];
                $sql = "UPDATE Giang_Vien SET  Ho_ten='".$name."', Email='".$email."', SDT='".$sdt."',ID_Khoa='".$id_khoa."' WHERE ID='".$id_get."'";
                $this->db->select($sql);
            }
        };
        //==================================== Phong hoc=================================== 
    
    
    
        class phong_hoc{
            public $db;
            public function __construct()
            {
                $this->db = new DataBase();
            }
            public function select(){
                $sql = "SELECT * FROM phong_hoc";
                $result=$this->db->select($sql);
                return $result;
            }
            public function select_name($name){
                $sql = "SELECT * FROM phong_hoc WHERE name='".$name."'";
                $result=$this->db->select($sql);
                return $result;
            }
            public function insert(){
                $name=$_POST['name'];
                $toa=$_POST['toa'];
                $co_so=$_POST['co_so'];
                $sql = "INSERT INTO phong_hoc VALUES ('".$name."','".$toa."','".$co_so."')";
                $this->db->select($sql);
            }
            public function delete(){
                $name =  $_GET['name'];
                $sql = "DELETE FROM phong_hoc WHERE name='".$name."'";
                $this->db->select($sql);

            }
            public function update(){
                $name =  $_SESSION['name'];
                $toa =  $_POST['toa'];
                $co_so =  $_POST['co_so'];
                $sql = "UPDATE phong_hoc  SET toa='".$toa."', co_so='".$co_so."' WHERE name='".$name."'";
                $this->db->select($sql);
            }
        }
?>