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
          ?>

               </div>
                <!-- ------head end------- -->
     <!-- ============================================BODY========================================== -->

     <hr>
<?php include('chose.php') ?>
     <hr>
               <!-- ============================================table========================================== --> 
          <button onclick="location.href='class.php?action=insert'">Them</button>
          <div class="table-wrapper">
              
                    </table>
               </div>
          </div>
     <?php
          include('../assets/inc/footer.php')
    ?>