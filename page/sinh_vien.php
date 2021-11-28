<?php
     include('../assets/inc/head.php')
?>
     <div class="container">
         
           <div class="head-wrapper">  

<?php 
    include('../func/data_connect.php');


    //SESSION-----------------------------

     session_start();
     if(isset($_GET['action']) && $_GET['action']!=''){
          $_SESSION['action']=$_GET['action'];
    }
    if(isset($_GET['id_get']) && $_GET['id_get']!=''){
          $_SESSION['id']=$_GET['id_get'];
     } 


     //CALL CLASS------------------------

     $sinh_vien =new Sinh_Vien();
     $khoa = new khoa();
     $sql=$sinh_vien->select();//call table

     // SUBMIT CLICK ------------------------
          //INSERT-----
     if(isset($_POST['submit']) && $_POST['submit']=='OK'){
          $sinh_vien->insert();
          $_SESSION['action']= 'insert_done';
          header('location:sinh_vien.php');
      }
       //UPDATE-----
     else if(isset($_POST['update']) && $_POST['update']=='OK'){
            $sinh_vien->update();
            $_SESSION['action']= 'update_done';
            header('location:sinh_vien.php');
     }

     //SHOW WORK UPDATE---------------------
          //UPDATE---------
               if(isset($_SESSION['action']) && $_SESSION['action']=='update')     
               {
                    $sinh_vien_id_get =  $_SESSION['id'];
                    $query_sinh_vien_update = $sinh_vien->select_id($sinh_vien_id_get);
                    $row_sinh_vien_update = $query_sinh_vien_update->fetch_assoc();
               ?>    
                    <button onclick="location.href='sinh_vien.php?action=close'">close</button>
                    <form action="sinh_vien.php" method="POST">
                              <table border="1">
                                   <tr>
                                        <td>ID</td>
                                        <td><?php echo $row_sinh_vien_update['ID']?></td>
                                   </tr>    
                                   <tr>
                                        <td>name</td>
                                        <td><input type="text" name="Ho_ten" value="<?php echo $row_sinh_vien_update['Ho_ten']?>"></td>
                                   </tr>  
                                   <tr>
                                        <td>Lop</td>
                                        <td><input type="text" name="Lop" value="<?php echo $row_sinh_vien_update['Lop']?>"></td>
                                   </tr> 
                                   <tr>
                                        <td>Email</td>
                                        <td><input type="text" name="Email" value="<?php echo $row_sinh_vien_update['Email']?>"></td>
                                   </tr>  
                                   <tr>
                                        <td>Tinh trang hoc</td>
                                        <td>
                                             <select name="TT_hoc">
                                                  <option value="Bình thường">Bình thường</option>
                                                  <option value="Tạm dừng">Tạm dừng</option>
                                                  <option value="Buộc thôi học">Buộc thôi học</option> 
                                             </select>
                                             <span>Tinh trang luc truoc: <?php echo $row_sinh_vien_update['TT_hoc']?></span>
                                        </td>
                                   </tr>  
                                   <tr>
                                        <td>Khoa</td>
                                        <td>
                                             <select name="khoa_ID">
                                                  <?php 
                                                       $sql_khoa = $khoa->select();
                                                       while($row_khoa_id = $sql_khoa->fetch_assoc()){
                                                  ?>
                                                       <option value="<?php echo $row_khoa_id['ID']?>"><?php echo $row_khoa_id['name']?></option> 
                                                  <?php 
                                                       }
                                                  ?>
                                             </select>
                                        </td>
                                   </tr>         
                              </table>
                         <input type="submit" value="OK" name="update" >
                    </form>
               
               <?php }//end update

          //DELETE---------

               else if (isset($_GET['action']) && $_GET['action']=='delete')
               {
                         $sinh_vien->delete();
                         header('location:sinh_vien.php');
               }//end delete


          //INSERT WORK ---------


               else if (isset($_SESSION['action']) && $_SESSION['action']=='insert')
               {?>
                    <button onclick="location.href='sinh_vien.php?action=close'">close</button>
                    <form action="sinh_vien.php" method="POST">
                              <table border="1">
                                   <tr>
                                        <td>ID</td>
                                        <td><input type="text" name="ID"></td>
                                   </tr>    
                                   <tr>
                                        <td>name</td>
                                        <td><input type="text" name="Ho_ten"></td>
                                   </tr>  
                                   <tr>
                                        <td>Lop</td>
                                        <td><input type="text" name="Lop"></td>
                                   </tr> 
                                   <tr>
                                        <td>Email</td>
                                        <td><input type="text" name="Email"></td>
                                   </tr>  
                                   <tr>
                                        <td>Tinh trang hoc</td>
                                        <td>
                                             <select name="TT_hoc">
                                                  <option value="Bình thường">Bình thường</option>
                                                  <option value="Tạm dừng">Tạm dừng</option>
                                                  <option value="Buộc thôi học">Buộc thôi học</option> 
                                             </select>
                                             
                                        </td>
                                   </tr>  
                                   <tr>
                                        <td>Khoa</td>
                                        <td>
                                             <select name="khoa_ID">
                                                  <?php 
                                                       $sql_khoa = $khoa->select();
                                                       while($row_khoa_id = $sql_khoa->fetch_assoc()){
                                                  ?>
                                                       <option value="<?php echo $row_khoa_id['ID']?>"><?php echo $row_khoa_id['name']?></option> 
                                                  <?php 
                                                       }
                                                  ?>
                                             </select>
                                             
                                        </td>
                                   </tr>         
                              </table>
                         <input type="submit" value="OK" name="submit" >
                    </form>
     <?php } //end insert
                         //Thong bao thanh cong
                         else if (isset($_SESSION['action']) && $_SESSION['action']=='update_done'){
                              echo 'ban da cap nhat thanh cong';
                              ?><button onclick="location.href='sinh_vien.php?action=close'">Close</button><?php
                         }
                         else if (isset($_SESSION['action']) && $_SESSION['action']=='insert_done'){
                              echo 'ban da them thanh cong';
                              ?><button onclick="location.href='sinh_vien.php?action=close'">Close</button><?php
                         }
     ?>

            <!-- Menu -->
            </div>
          <hr>
<?php include('chose.php') ?>
          <hr>
               <h3>Quan li Sinh Vien</h3>

               <!-- nut them -->
               
               <button onclick="location.href='sinh_vien.php?action=insert'">Them</button>
               <div class="table-wrapper">
                         <table border="1" class="table-center">
                                   <tr class="tilte-table">
                                   <td>ID</td>
                                   <td>Name</td>
                                   <td>Lop</td>
                                   <td>Email</td>
                                   <td>Tinh trang hoc tap</td>
                                   <td>khoa</td>
                              </tr>
                                   <?php 
                                        while($row = $sql->fetch_assoc()){
                                        $id_khoa_get = $row['khoa_ID'];
                                        $sql_khoa_id = $khoa->select_id($id_khoa_get);
                                        $row_khoa_id = $sql_khoa_id->fetch_assoc();
                                   ?>
                              <tr>
                                   <td><?php echo $row['ID']?></td>
                                   <td><?php echo $row['Ho_ten']?></td>
                                   <td><?php echo $row['Lop']?></td>
                                   <td><?php echo $row['Email']?></td>
                                   <td><?php echo $row['TT_hoc']?></td>
                                   <td><?php echo $row_khoa_id['name']?></td>
                                   <td>
                                        <button onclick="location.href='sinh_vien.php?action=update&id_get=<?php echo $row['ID']?>'">Chinh</button>
                                        <button onclick="location.href='sinh_vien.php?action=delete&id_get=<?php echo $row['ID']?>'">Xoa</button>
                                        <button onclick="location.href='sinh_vien.php?action=detail&id_get=<?php echo $row['ID']?>'">chi tiet</button>
                                   </td>
                              </tr>
                                   <?php }?>
                         </table>
                    </div>
          </div>
<?php
     include('../assets/inc/footer.php')
?>