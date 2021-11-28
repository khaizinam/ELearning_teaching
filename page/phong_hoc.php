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
          if(isset($_GET['name']) && $_GET['name']!=''){
               $_SESSION['name']=$_GET['name'];
          } 
  
  
       //CALL CLASS------------------------
  
          $phong_hoc =new phong_hoc();
          $sql=$phong_hoc->select();//call table


          // SUBMIT CLICK ------------------------
          //INSERT-----
          if(isset($_POST['submit']) && $_POST['submit']=='OK'){
               $phong_hoc->insert();
               $_SESSION['action']= 'insert_done';
               header('location:phong_hoc.php');
          }
          //UPDATE-----
          else if(isset($_POST['update']) && $_POST['update']=='OK'){
               $phong_hoc->update();
               $_SESSION['action']= 'update_done';
               header('location:phong_hoc.php');
          }

          //SHOW WORK UPDATE---------------------
          //UPDATE---------
          if(isset($_SESSION['action']) && $_SESSION['action']=='update')     
          {
               $get_name =  $_SESSION['name'];
               $query_ph_update = $phong_hoc->select_name($get_name);
               $row_ph_update = $query_ph_update->fetch_assoc();
          ?>    
               <button onclick="location.href='phong_hoc.php?action=close'">close</button>
               <form action="phong_hoc.php" method="POST">
                         <table border="1">
                                   <tr>
                                        <td>Ten</td>
                                        <td><?php echo $row_ph_update['name']?></td>
                                   </tr>    
                                   <tr>
                                        <td>Toa</td>
                                        <td><input type="text" name="toa" value="<?php echo $row_ph_update['toa']?>"></td>
                                   </tr>  
                                   <tr>
                                        <td>Co so</td>
                                        <td><select name="co_so">
                                             <option value="Co so 1"> Co so 1</option>
                                             <option value="Co so 2"> Co so 2</option>
                                        </select></td>
                                   </tr>     
                         </table>
                    <input type="submit" value="OK" name="update" >
               </form>
          
          <?php }//end update

     //DELETE---------

          else if (isset($_GET['action']) && $_GET['action']=='delete')
          {
                    $phong_hoc->delete();
                    header('location:phong_hoc.php');
          }//end delete


     //INSERT WORK ---------


          else if (isset($_SESSION['action']) && $_SESSION['action']=='insert')
          {?>
               <button onclick="location.href='phong_hoc.php?action=close'">close</button>
               <form action="phong_hoc.php" method="POST">
                         <table border="1">
                              <tr>
                                   <td>Ten</td>
                                   <td><input type="text" name="name"></td>
                              </tr>
                              <tr>
                                   <td>Toa</td>
                                   <td><input type="text" name="toa"></td>
                              </tr>
                              <tr>
                                   <td>Co so</td>
                                   <td><select name="co_so">
                                        <option value="Co so 1"> Co so 1</option>
                                        <option value="Co so 2"> Co so 2</option>
                                   </select></td>
                              </tr>
                         </table>    
                         <input type="submit" value="OK" name="submit" >
               </form>
<?php } //end insert
                    //Thong bao thanh cong
                    else if (isset($_SESSION['action']) && $_SESSION['action']=='update_done'){
                         echo 'ban da cap nhat thanh cong';
                         ?><button onclick="location.href='phong_hoc.php?action=close'">Close</button><?php
                    }
                    else if (isset($_SESSION['action']) && $_SESSION['action']=='insert_done'){
                         echo 'ban da them thanh cong';
                         ?><button onclick="location.href='phong_hoc.php?action=close'">Close</button><?php
                    }

?>
           </div>

     <hr>
     <?php include('chose.php') ?>
     <hr>
               <h3>Danh sach phong hoc</h3>
               <button onclick="location.href='phong_hoc.php?action=insert'">Them</button>
               <!-- nut them -->
               
              
               <div class="table-wrapper">
                         <table border="1" class="table-center">
                              <tr class="tilte-table">
                                   <td>Ten</td>
                                   <td>Toa</td>
                                   <td>Co so</td>
                                   <td>Tuy chon</td>
                              </tr>
                                   <?php 
                                        while($row = $sql->fetch_assoc()){
                                   ?>
                              <tr>
                                   </td>
                                   <td><?php echo $row['name']?></td>
                                   <td><?php echo $row['toa']?></td>
                                   <td><?php echo $row['co_so']?></td>
                                   <td>
                                        <button onclick="location.href='phong_hoc.php?action=update&name=<?php echo $row['name']?>'">Chinh</button>
                                        <button onclick="location.href='phong_hoc.php?action=delete&name=<?php echo $row['name']?>'">Xoa</button>
                                   </td>
                              </tr>
                                   <?php }?>
                         </table>    
               </div>
     </div>
<?php
     include('../assets/inc/footer.php')
?>