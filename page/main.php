<?php
     include('../assets/inc/head.php')
?>
     <div class="container">
         
           <div class="head-wrapper">  
                
<?php 
        include('../func/data_connect.php');
    //SESSION CALL-----------------
    session_start();
    if(isset($_GET['action']) && $_GET['action']!=''){
        $_SESSION['action']=$_GET['action'];
    }
    if(isset($_GET['id_get']) && $_GET['id_get']!=''){
        $_SESSION['id']=$_GET['id_get'];
    }

    //CLASS CALL---------------------------
     $giang_vien= new Giang_Vien();
     $subject = new Mon_Hoc();
     $nhom_lop = new Nhom_lop();
     $khoa = new khoa();
     $sql=$giang_vien->select();

   //SUBMIT WORK--------------------------

   if(isset($_POST['submit']) && $_POST['submit']=='OK'){
         $giang_vien->insert();
         $_SESSION['action']='insert_done';
         header('location:main.php');
   }else if(isset($_POST['update']) && $_POST['update']=='OK'){
         $giang_vien->update();
         $_SESSION['action']='update_done';
         header('location:main.php');
    }
    //UPDATE WORK---------------------
    //UPDATE---
   if(isset($_SESSION['action']) && $_SESSION['action']=='update')     
   {
     //     $MH_id_get = $_SESSION['id'];
     //     $query_MH_id = $subject->select_id($MH_id_get);
     //     $row_MH_update = sqlsrv_fetch_array($query_MH_id,SQLSRV_FETCH_ASSOC);
         ?>
         
   <?php } 
   //DELETE-----------------------
   else if (isset($_GET['action']) && $_GET['action']=='delete')
   {
         $giang_vien->delete();
         header('location:main.php');
   }//end delete

   //INSERT-----------------
   else if (isset($_SESSION['action']) && $_SESSION['action']=='insert')
   {?>
          <button onclick="location.href='main.php?action=close'">close</button>
          <form action="main.php" method="POST">
               <table border="1">
                         <tr>
                              <td>ID</td>
                              <td><input type="text" name="ID"></td>
                         </tr>   
                         <tr>
                              <td>Ten</td>
                              <td><input type="text" name="Ho_ten"></td>
                         </tr>   
                         <tr>
                              <td>Email</td>
                              <td><input type="text" name="Email"></td>
                         </tr>   
                         <tr>
                              <td>SDT</td>
                              <td><input type="text" name="SDT"></td>
                         </tr>   
                         <tr>
                              <td>ID Khoa</td>
                              <td><select name="ID_Khoa" >
                                   <?php
                                        $query_khoa=$khoa->select();
                                        while($row_id_khoa = $query_khoa->fetch_assoc()){
                                   ?>
                                   <option value="<?php echo $row_id_khoa['ID']?>"><?php echo $row_id_khoa['ID']?></option>
                                   <?php } ?>             
                              </select></td>
                         </tr>        
                    </table>
               <input type="submit" value="OK" name="submit" >
        </form>
    <?php }//end insert 
                    //Thong bao thanh cong
                    else if (isset($_SESSION['action']) && $_SESSION['action']=='update_done'){
                        echo 'ban da cap nhat thanh cong';
                        ?><button onclick="location.href='main.php?action=close'">Close</button><?php
                   }
                   else if (isset($_SESSION['action']) && $_SESSION['action']=='insert_done'){
                        echo 'ban da them thanh cong';
                        ?><button onclick="location.href='main.php?action=close'">Close</button><?php
                   }
                       
    ?>
     </div>
          <hr>
<?php include('chose.php') ?>
          <hr>
               
          <h3>Giang Vien</h3>
          <button onclick="location.href='main.php?action=insert'">Them</button>   
          <div class="table-wrapper">
                         <table border="1" class="table-center">
                              <tr class="tilte-table">
                              <td>ID</td>
                              <td>ten</td>
                              <td>Email</td>
                              <td>SDT</td>
                              <td>khoa</td>
                         </tr>
                              <?php while($row = $sql->fetch_assoc()){
                                   $id_khoa_get= $row['ID_Khoa'];
                                   $query_khoa_list = $khoa->select_id($id_khoa_get); 
                                   $row_khoa_list = $query_khoa_list->fetch_assoc();
                              ?>
                         <tr>
                              <td><?php echo $row['ID']?></td>
                              <td><?php echo $row['Ho_ten']?></td>
                              <td><?php echo $row['Email']?></td>
                              <td><?php echo $row['SDT']?></td>
                              <td><?php echo $row_khoa_list['name']?></td>
                              <td>
                                   <button onclick="location.href='main.php?action=detail&id_get=<?php echo $row['ID']?>'">Chi tiet</button>
                                   <button onclick="location.href='main.php?action=update&id_get=<?php echo $row['ID']?>'">Chinh sua</button>
                                   <button onclick="location.href='main.php?action=delete&id_get=<?php echo $row['ID']?>'">Xoa</button>
                              </td>
                         </tr>
                              <?php }?>
                    </table>
               </div>
          </div>
<?php
     include('../assets/inc/footer.php')
?>