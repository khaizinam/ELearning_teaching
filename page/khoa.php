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

    //CALL CLASS----------------------------

    $khoa = new khoa();
    $sql= $khoa->select();

    //SUBMIT WORK-------------------------------
          //INSERT-----
          if(isset($_POST['submit']) && $_POST['submit']=='OK'){
               $khoa->insert();
               $_SESSION['action'] = 'insert_done';
               header('location:khoa.php');
          }
          //UPDATE-----
          else if(isset($_POST['update']) && $_POST['update']=='OK'){
               $khoa->update();
               $_SESSION['action'] = 'update_done';
               header('location:khoa.php');
          }
    //SHOW WORK UPDATE---------------------
          //UPDATE---------
          if(isset($_SESSION['action']) && $_SESSION['action']=='update')     
          {    
               $khoa_id_get =  $_SESSION['id'];
               $query_khoa_update = $khoa->select_id($khoa_id_get);
               $row_khoa_update = $query_khoa_update->fetch_assoc();
          ?>    
               <button onclick="location.href='khoa.php?action=close'">close</button>
                    <form action="khoa.php" method="POST">
                         <table border="1">
                              <tr>
                                   <td>ID</td>
                                   <td><?php echo $row_khoa_update['ID'];?></td>
                              </tr>   
                              <tr>
                                   <td>Ten</td>
                                   <td><input type="text" name="name" value="<?php echo $row_khoa_update['name'];?>"></td>
                              </tr>  
                         </table>
                         <input type="submit" value="OK" name="update">
                    </form>
          
          <?php }//end update

     //DELETE---------

          else if (isset($_GET['action']) && $_GET['action']=='delete')
          {

                    $khoa->delete();
                    header('location:khoa.php');
          }//end delete


     //INSERT WORK ---------


          else if (isset($_SESSION['action']) && $_SESSION['action']=='insert')
          {?>
                    <button onclick="location.href='khoa.php?action=close'">close</button>
                    <form action="khoa.php" method="POST">
                         <table border="1">
                              <tr>
                                   <td>ID</td>
                                   <td><input type="text" name="ID"></td>
                              </tr>   
                              <tr>
                                   <td>Ten</td>
                                   <td><input type="text" name="name"></td>
                              </tr>  
                         </table>
                         <input type="submit" value="OK" name="submit">
                    </form>
<?php } //end insert 
          //Thong bao thanh cong
          else if (isset($_SESSION['action']) && $_SESSION['action']=='update_done'){
               echo 'ban da cap nhat thanh cong';
               ?><button onclick="location.href='khoa.php?action=close'">Close</button><?php
          }
          else if (isset($_SESSION['action']) && $_SESSION['action']=='insert_done'){
               echo 'ban da them thanh cong';
               ?><button onclick="location.href='khoa.php?action=close'">Close</button><?php
          }
?>
          </div>
          <hr>
<?php include('chose.php') ?>
          <hr>
          <h3>Quan li Khoa</h3>
          <button onclick="location.href='khoa.php?action=insert'">Them</button>
          <div class="table-wrapper">
               <table border="1" class="table-center">
                    <tr class="tilte-table">
                         <td>ID</td>
                         <td>Ten khoa</td>
                         <td>Tuy chinh</td>
                    </tr>
                         <?php while($row = $sql->fetch_assoc()){?>
                    <tr>
                         <td><?php echo $row['ID']?></td>
                         <td><?php echo $row['name']?></td>
                         <td>
                              <button onclick="location.href='khoa.php?action=update&id_get=<?php echo $row['ID']?>'">Chinh</button>
                              <button onclick="location.href='khoa.php?action=detail&id_get=<?php echo $row['ID']?>'">chi tiet</button>
                              <button onclick="location.href='khoa.php?action=delete&id_get=<?php echo $row['ID']?>'">Xoa</button>
                         </td>
                    </tr>
                         <?php }?>
               </table>
          </div>
     </div>
<?php
     include('../assets/inc/footer.php')
?>