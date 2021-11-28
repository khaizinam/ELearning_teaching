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

    $subject = new Mon_Hoc();
    $nhom_lop = new Nhom_lop();
    $giang_vien = new Giang_Vien();
    $sql=$subject->select();

    //SUBMIT WORK--------------------------

    if(isset($_POST['submit']) && $_POST['submit']=='OK'){
          $subject->insert();
          $_SESSION['action']='insert_done';
          header('location:mon_hoc.php');
    }else if(isset($_POST['update']) && $_POST['update']=='OK'){
          $subject->update();
          $_SESSION['action']='update_done';
          header('location:mon_hoc.php');
     }
     //UPDATE WORK---------------------
     //UPDATE---
    if(isset($_SESSION['action']) && $_SESSION['action']=='update')     
    {
          $MH_id_get = $_SESSION['id'];
          $query_MH_id = $subject->select_id($MH_id_get);
          $row_MH_update = $query_MH_id->fetch_assoc();
          ?>
          <button onclick="location.href='mon_hoc.php?action=close'">close</button>
          <form action="mon_Hoc.php" method="POST">
               <table border="1" >
                         <tr>
                              <td>ID</td>
                              <td><?php echo $row_MH_update['ID']?></td>
                         </tr>   
                         <tr>
                              <td>Ten</td>
                              <td><input type="text" name="Ten_MH" value="<?php echo $row_MH_update['Ten_MH']?>"></td>
                         </tr>  
                         <tr>
                              <td>STC</td>
                              <td><input type="number" min="1" max="18" name="So_TC" value="<?php echo $row_MH_update['So_TC']?>"></td>
                         </tr>  
                    </table>
                    <input type="submit" value="OK" name="update">
               </form>
    <?php } 
    //DELETE-----------------------
    else if (isset($_GET['action']) && $_GET['action']=='delete')
    {
          $subject->delete();
          header('location:mon_hoc.php');
    }//end delete

    //INSERT-----------------
    else if (isset($_SESSION['action']) && $_SESSION['action']=='insert')
    {?>
           <button onclick="location.href='mon_hoc.php?action=close'">close</button>
          <form action="mon_Hoc.php" method="POST">
               <table border="1">
                         <tr>
                              <td>ID</td>
                              <td><input type="text" name="ID"></td>
                         </tr>   
                         <tr>
                              <td>Ten</td>
                              <td><input type="text" name="Ten_MH"></td>
                         </tr>  
                         <tr>
                              <td>STC</td>
                              <td><input type="number" min="1" max="18" name="So_TC"></td>
                         </tr>  
                    </table>
                    <input type="submit" value="OK" name="submit" >
               </form>
     <?php }//end insert 
                     //Thong bao thanh cong
                     else if (isset($_SESSION['action']) && $_SESSION['action']=='update_done'){
                         echo 'ban da cap nhat thanh cong';
                         ?><button onclick="location.href='mon_hoc.php?action=close'">Close</button><?php
                    }
                    else if (isset($_SESSION['action']) && $_SESSION['action']=='insert_done'){
                         echo 'ban da them thanh cong';
                         ?><button onclick="location.href='mon_hoc.php?action=close'">Close</button><?php
                    }
                    //DETAIL-----------------
                         else if (isset($_SESSION['action']) && $_SESSION['action']=='detail')
                         {
                                   $id_get_detail = $_SESSION['id'];
                                   //query
                                   $query_nhom_lop_detail = $nhom_lop->select_id_MH($id_get_detail);
                                   $query_mon_hoc_detail = $subject->select_id($id_get_detail);
                                   //row
                                   $row_mon_hoc = $query_mon_hoc_detail->fetch_assoc();                                
     ?>
                                   <button onclick="location.href='mon_hoc.php?action=close'">close</button>
                                   <p><?php echo $row_mon_hoc['Ten_MH'].' [ '.$row_mon_hoc['ID'].' ] so tin chi : '.$row_mon_hoc['So_TC']; ?></p>
                                             <table border="1" class="table-center">
                                                  <tr class="tilte-table">
                                                       <td>Lop</td>
                                                       <td>Phong hoc</td>
                                                       <td>Giang vien phu trach</td>
                                                       <td>ID Giang vien</td>
                                                       <td>Ngay hoc</td>
                                                       <td>Tiet hoc</td>
                                                       <td>Tuan hoc</td>
                                                  </tr>
                                                       <?php while( $row_detail = $query_nhom_lop_detail->fetch_assoc()){?>
                                                  <tr>
                                                       <td><?php echo $row_detail['ten']?></td>
                                                       <td><?php echo $row_detail['Phong_hoc']?></td>
                                                       <td>
                                                            <?php     
                                                                 $id_giang_vien_get = $row_detail['id_giang_vien'];
                                                                 $query_giang_vien_detail = $giang_vien->select_id($id_giang_vien_get);
                                                                 $row_giang_vien = $query_giang_vien_detail->fetch_assoc();
                                                                 echo $row_giang_vien['Ho_ten']
                                                             ?>
                                                       </td>
                                                       <td><?php echo $row_detail['id_giang_vien']?></td>
                                                       <td>2 4 6</td>
                                                       <td><?php echo $row_detail['tiet_bat_dau'].' - '.$row_detail['tiet_ket_thuc']?></td>
                                                       <td>45 47 49</td>
                                                  </tr>
                                                       <?php }?>
                                             </table>

                              <?php }//end detail
     ?>
     </div>
     <!-- end head -->
     <hr>
<?php include('chose.php') ?>
          <hr>
     <h3>Quan li Mon hoc</h3>
     <button onclick="location.href='mon_hoc.php?action=insert'">Them</button>
                    <div class="table-wrapper">
                         <table border="1" class="table-center">
                              <tr class="tilte-table">
                                   <td style="width: 80px;">ID</td>
                                   <td style="width: 100px;">Ten</td>
                                   <td style="width: 80px;">So Tin chi</td>
                                   <td style="width: 200px;">Tuy chon</td>
                              </tr>
                                   <?php while($row = $sql->fetch_assoc()){?>
                              <tr>
                                   <td><?php echo $row['ID']?></td>
                                   <td><?php echo $row['Ten_MH']?></td>
                                   <td><?php echo $row['So_TC']?></td>
                                   <td>
                                        <button onclick="location.href='mon_hoc.php?action=detail&id_get=<?php echo $row['ID']?>'">Chi tiet</button>
                                        <button onclick="location.href='mon_hoc.php?action=update&id_get=<?php echo $row['ID']?>'">Chinh sua</button>
                                        <button onclick="location.href='mon_hoc.php?action=delete&id_get=<?php echo $row['ID']?>'">Xoa</button>
                                   </td>
                              </tr>
                                   <?php }?>
                         </table>
                    </div>
          </div>
<?php
     include('../assets/inc/footer.php')
?>