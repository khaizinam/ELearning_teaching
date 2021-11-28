    <?php
          include('../assets/inc/head.php')
    ?>
     <div class="container">
         

           <div class="head-wrapper">  

         <?php 
          include('../func/data_connect.php');
          //SESSION CALL--------------------------
          session_start();
               if(isset($_GET['action']) && $_GET['action']!=''){
                    $_SESSION['action']=$_GET['action'];
          }
          if(isset($_GET['id_get']) && $_GET['id_get']!=''){
                    $_SESSION['id']=$_GET['id_get'];
               }
               //CLASS CALL----------------------------------

          $class = new Nhom_Lop();
          $giang_vien= new Giang_Vien();
          $phong_hoc= new phong_hoc();
          $subject = new Mon_Hoc();

          $sql= $class->select();
               //SUBMIT WORK-------------------------------------------------------
          if(isset($_POST['submit']) && $_POST['submit']=='OK'){
               $class->insert();
               header('location:class.php');
          }
          else if(isset($_POST['update']) && $_POST['update']=='OK'){
                    $class->update();
                    header('location:class.php');
               }
               //UPDATE WORK-----------------------------------------
               //UPDATE--
          if(isset($_SESSION['action']) && $_SESSION['action']=='update')     
          {
               $class_id_get = $_SESSION['id'];
                    $query_class_id = $class->select_id($class_id_get);
                    $row_class_update = $query_class_id->fetch_assoc();
          ?>   
                    <button onclick="location.href='class.php?action=close'">close</button> 
                    <form action="class.php" method="POST">
                         <table border="1">
                              <tr>
                                   <td>ID</td>
                                   <td><?php echo $row_class_update['ID'] ?></td>
                              </tr>  
                              <tr>
                                   <td>Ten</td>
                                   <td><input type="text" name="ten" value="<?php echo $row_class_update['ten'] ?>"></td>
                              </tr>   
                              <tr>
                                   <td>Tiet bat dau</td>
                                   <td><input type="text" name="tiet_bat_dau" value="<?php echo $row_class_update['tiet_bat_dau'] ?>"></td>
                              </tr>  
                              <tr>
                                   <td>Tiet ket thuc</td>
                                   <td><input type="text" name="tiet_ket_thuc" value="<?php echo $row_class_update['tiet_ket_thuc'] ?>"></td>
                              </tr>   
                              <tr>
                                   <td>Phong hoc</td>
                                   <td><input type="text" name="Phong_hoc" value="<?php echo $row_class_update['Phong_hoc'] ?>"></td>
                              </tr>  
                              <tr>
                                   <td>Giang Vien</td>
                                   <td>
                                        <select name="id_giang_vien" >
                                             <?php
                                                  $query_GV=$giang_vien->select();
                                                  while($row_GV = $query_GV->fetch_assoc()){
                                             ?>
                                                  <option value="<?php echo $row_GV['ID']?>"><?php echo $row_GV['Ho_ten']?></option>
                                             <?php } ?>             
                                        </select>
                                   </td>
                              </tr> 
                              <tr>
                                   <td>Id Mon hoc</td>
                                   <td><select name="ID_Monhoc" >
                                        <?php
                                             $query_MH=$subject->select();
                                             while($row_id_MH = $query_MH->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row_id_MH['ID']?>"><?php echo $row_id_MH['ID']?></option>
                                        <?php } ?>             
                                   </select> <span>ID Mon hoc o du lieu truoc : <?php echo $row_class_update['id_monhoc'] ?></span></td>
                              </tr>  
                         </table>
                    <input type="submit" value="OK" name="update" >
                    </form>
          <?php }
               //DELETE--
               else if (isset($_GET['action']) && $_GET['action']=='delete')
               {
                         $class->delete();
                         header('location:class.php');
               } 
               //INSERT--
               else if (isset($_SESSION['action']) && $_SESSION['action']=='insert')
               {?>
                    <button onclick="location.href='class.php?action=close'">close</button>
                    <form action="class.php" method="POST">
                              <table border="1">
                                   <tr>
                                        <td>ID</td>
                                        <td><input type="text" name="id"></td>
                                   </tr> 
                                   <tr>
                                        <td>Ten</td>
                                        <td><input type="text" name="ten"></td>
                                   </tr>      
                                   <tr>
                                        <td>Tiet hoc bat dau</td>
                                        <td><input type="text" name="start"></td>
                                   </tr> 
                                   <tr>
                                        <td>Tiet hoc ket thuc</td>
                                        <td><input type="text" name="end"></td>
                                   </tr>   
                                   <tr>
                                        <td>Phong hoc</td>
                                        <td>
                                             <select name="Phong_hoc" >
                                             <?php
                                                  $query_ph=$phong_hoc->select();
                                                  while($row_ph = $query_ph->fetch_assoc()){
                                             ?>
                                             <option value="<?php echo $row_ph['name']?>"><?php echo $row_ph['name']?></option>
                                             <?php } ?>             
                                        </select>
                                        </td>
                                   </tr>  
                                   <tr>
                                        <td>Giang Vien</td>
                                        <td>
                                             <select name="id_giang_vien" >
                                             <?php
                                                  $query_GV=$giang_vien->select();
                                                  while($row_GV = $query_GV->fetch_assoc()){
                                             ?>
                                             <option value="<?php echo $row_GV['ID']?>"><?php echo $row_GV['Ho_ten']?></option>
                                             <?php } ?>             
                                        </select>
                                        </td>
                                   </tr> 
                                   <tr>
                                        <td>Id Mon hoc</td>
                                        <td><select name="id_mon_hoc" >
                                             <?php
                                                  $query_MH=$subject->select();
                                                  while($row_id_MH =  $query_MH->fetch_assoc()){
                                             ?>
                                             <option value="<?php echo $row_id_MH['ID']?>"><?php echo $row_id_MH['ID']?></option>
                                             <?php } ?>             
                                        </select></td>
                                   </tr>  
                              </table>
                         <input type="submit" value="OK" name="submit" >
                    </form>
               <?php } ?>

               </div>
                <!-- ------head end------- -->
     <!-- ============================================BODY========================================== -->

     <hr>
<?php include('chose.php') ?>
     <hr>
               <!-- ============================================table========================================== --> 
          <h3>Quan li lop hoc</h3>
          <button onclick="location.href='class.php?action=insert'">Them</button>
          <div class="table-wrapper">
               <table border="1">
                         <tr class="tilte-table" style="background: red;">
                              <td style="width: 80px;">ID</td>
                              <td style="width: 80px;">Ten</td>
                              <td style="width: 80px;">Tiet hoc</td>
                              <td style="width: 80px;">Phong hoc</td>
                              <td style="width: 200px;">Ngay hoc</td>
                              <td style="width: 200px;">Tuan hoc</td>
                              <td style="width: 120px;">Giang vien phu trach</td>
                              <td style="width: 80px;">Id Mon hoc</td>
                              <td style="width: 200px;">Tuy chon</td>
                         </tr>
                              <?php while($row = $sql->fetch_assoc()){?>
                         <tr>
                              <td><?php echo $row['ID']?></td>
                              <td><?php echo $row['ten']?></td>
                              <td><?php echo $row['tiet_bat_dau']?> - <?php echo $row['tiet_ket_thuc']?></td>
                              <td><?php echo $row['Phong_hoc']?></td>
                              <td>2 4 6</td>
                              <td>25 45 45</td>
                              <td><?php echo $row['id_giang_vien']?></td>
                              <td><?php echo $row['id_monhoc']?></td>
                              <td>
                                   <button onclick="location.href='class.php?action=detail&id_get=<?php echo $row['ID']?>'">Chi tiet</button>
                                   <button onclick="location.href='class.php?action=update&id_get=<?php echo $row['ID']?>'">Chinh sua</button>
                                   <button onclick="location.href='class.php?action=delete&id_get=<?php echo $row['ID']?>'">xoa</button>
                              </td>

                         </tr>
                              <?php }?>
                    </table>
               </div>
          </div>
     <?php
          include('../assets/inc/footer.php')
    ?>