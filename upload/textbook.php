
<?php 

$sql_txtb_1 = $textbook->select();
//SESSION-----------------------------
//CALL CLASS----------------------------

$action = 'list';
if($_SERVER['REQUEST_METHOD']=='POST'){
     if(isset($_POST['textbook-register'])=='Register'){
         
          $_POST['textbook-register'] =='done';
          header('location:manager.php');
     }
     if(isset($_POST['textbook-update'])=='Update'){
          $_POST['textbook-update'] =='done';
          header('location:manager.php');
     }   
     if(isset($_POST['course-register'])=='Add'){
          $_POST['course-register'] =='done';
          header('location:manager.php?textbook-action=update');
     } 
}
if(isset($_GET['textbook-delete'])=='delete'){
     $id_get = $_GET['delete-id'];
     $_SESSION['message'] = $textbook->delete_sbj($id_get);
     header('location:manager.php');
}
//*******************  VIEW ***************************************//
if(isset($_GET['textbook-action']))
{
     $action = $_GET['textbook-action'];
};
if($action =='close' || $action =='list' || $action == 'delete'){
     if(isset($_GET['close-message'])=='1') unset($_SESSION['message']);
     if(isset($_SESSION['message'])){
          ?><span><?php echo $_SESSION['message'];?></span> 
          <a href="manager.php?close-message=1">close</a>
          <?php
     }
?>
     <h2>textbook</h2>
     <button onclick="location.href='manager.php?textbook-action=insert'">Register New textbook</button>
     <div class="table-wrapper">
          <table class="table-center">
               <tr class="row-firt">
                    <td>Text book Isbn</td>
                    <td>Text book  Name</td>
                    <td>Text book field</td>
                    <td>Author</td>
                    <td>Pulisher</td>
               </tr>
          </table>
     </div>












<?php
}else if($action =='insert'){
?>
      <button onclick="location.href='manager.php?textbook-action=list'">Back</button>
     <h2>textbook</h2>
     <button onclick="location.href='manager.php?textbook-action=insert'">Register New textbook</button>
     <div class="table-wrapper">
          <table class="table-center">
               <tr class="row-firt">
                    <td>Text book Isbn</td>
                    <td>Text book  Name</td>
                    <td>Text book field</td>
               </tr>
               <?php
                    while($row_txtb_1 = $sql_txtb_1->fetch_assoc()){
               ?>
               <tr>
                     <td>
                          <a href="manager.php?textbook-id=<?php echo $row_txtb_1['ID'] ?>&textbook-action=update">
                               <?php echo $row_txtb_1['Isbn']?>
                          </a>
                     </td>
                     <td>
                          <a href="manager.php?textbook-id=<?php echo $row_txtb_1['ID'] ?>&textbook-action=update">
                               <?php echo $row_txtb_1['title'];?>
                          </a>
                     </td>
                     <td>
                          <a href="manager.php?textbook-id=<?php echo $row_txtb_1['ID'] ?>&textbook-action=update">
                               <?php echo $row_txtb_1['file'];?>
                          </a>
                     </td>
               </tr>
               <?php 
                    } 
               ?>
          </table>
     </div>
<?php
//UPDATE
}else if($action =='update'){
     if(isset($_GET['textbook-id']))
     $_SESSION['textbookID'] = $_GET['textbook-id'];
     $sql_sbj_2 = $textbook->select_class( $_SESSION['textbookID']);
     $sql_sbj_3 = $textbook->select_id( $_SESSION['textbookID']);
     $row_sbj_3 = $sql_sbj_3->fetch_assoc();
?>
     <button onclick="location.href='manager.php?textbook-action=list'">Back</button>
     <h2>Course</h2>
     <span>textbook ID : <?php echo  $row_sbj_3['ID'] ?> </span><br>
     <span>textbook Name : <?php echo  $row_sbj_3['name'] ?></span><br>
     <span>Credits : <?php echo  $row_sbj_3['credits'] ?></span><br>
     <hr>
     <div class="table-wrapper">
          <table class="table-center">
               <tr class="row-firt">
                    <td>Class ID</td>
                    <td>Class Name</td>
                    <td>Num Student</td>
               </tr>
               <?php while($row_sbj_2 = $sql_sbj_2->fetch_assoc()){?>
               <tr>
                     <td>
                         <a href="manager.php?&textbook-action=class-list">
                              <?php echo $row_sbj_2['ID']?>
                         </a> 
                    </td>
                    <td>
                         <a href="manager.php?&textbook-action=class-list">
                              <?php echo $row_sbj_2['name']?>
                         </a> 
                    </td>
                    <td>
                         <?php echo '0 /'.$row_sbj_2['maximum']?>
                    </td>
               </tr>
               <?php }?>
          </table>
     </div>
     <button onclick="location.href='manager.php?textbook-delete=delete&delete-id=<?php echo  $row_sbj_3['ID'] ?>'">Delete this textbook</button>       
     <!--        ADD NEW COURSE          -->

     <h2> Add new Course</h2>
     <form action="manager.php" method="post">
          <input type="hidden" name="course-textbookID" value="<?php echo $_SESSION['textbookID'] ?>">
          <label for="course-id">course ID</label><br>
          <input class="input-1" type="text" name="course-id" placeholder="course id"><br>
          <label for="course-semester">Semester</label><br>
          <input class="input-1" type="text" name="course-semester" placeholder="semester"><br>
          <label for="course-name">course Name</label><br>
          <input class="input-1" type="text" name="course-name" placeholder="course Name"><br>
          <label for="course-maximun">Course maximun</label><br>
          <input class="input-1" type="number" min="1" max="60" name="course-maximun" placeholder="Course maximun"><br>
          <input class="btn-submit" type="submit" name="course-register" value="Add">
     </form>
<?php
}else if($action =='class-list'){
?>
      <button onclick="location.href='manager.php?textbook-action=update'">Back</button>
     <h2>Course</h2>
     <span>textbook ID : CO1003</span><br>
     <span>textbook Name : Cơ sở dữ liệu</span><br>
     <span>Credits : 3</span><br>
     <span>class : L05</span><br>
     <span>Lecturer manage class : AAA</span><br>
     <div class="table-wrapper">
          <table class="table-center">
               <tr class="row-firt">
                    <td>No</td>
                    <td>Student Name</td>
                    <td>Student ID</td>
               </tr>
               <tr>
                     <td>1</td>
                     <td>L05</td>
                     <td>60</td>
               </tr>
          </table>
     </div>     
<?php
}
?>


