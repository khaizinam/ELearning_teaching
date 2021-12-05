
<?php 

$sql_subj_1 = $subject->select();
//SESSION-----------------------------
//CALL CLASS----------------------------

$action = 'list';
if($_SERVER['REQUEST_METHOD']=='POST'){
     if(isset($_POST['subject-register'])=='Register'){
          $id_post = $_POST['subject-id'];
          $subjectName_post = $_POST['subject-name'];
          $credits_post = $_POST['subject-credits'];
          $_SESSION['message']=$subject->insert($id_post,$subjectName_post, $credits_post );
          $_POST['subject-register'] =='done';
          header('location:manager.php');
     }
     if(isset($_POST['subject-update'])=='Update'){
          $_POST['subject-update'] =='done';
          header('location:manager.php');
     }   
     if(isset($_POST['course-register'])=='Add'){
          $course_id_post = $_POST['course-id'];
          $course_semester_post = $_POST['course-semester'];
          $courseName_post = $_POST['course-name'];
          $coursemax_post = $_POST['course-maximun'];
          $courseSubID_post = $_POST['course-subjectID'];
          $subject->add_class($course_id_post,$course_semester_post, $courseName_post,$coursemax_post, $courseSubID_post);
          $_POST['course-register'] =='done';
          header('location:manager.php?subject-action=update');
     } 
}
if(isset($_GET['subject-delete'])=='delete'){
     $id_get = $_GET['delete-id'];
     $_SESSION['message'] = $subject->delete_sbj($id_get);
     header('location:manager.php');
}
//*******************  VIEW ***************************************//
if(isset($_GET['subject-action']))
{
     $action = $_GET['subject-action'];
};
if($action =='close' || $action =='list' || $action == 'delete'){
     if(isset($_GET['close-message'])=='1') unset($_SESSION['message']);
     if(isset($_SESSION['message'])){
        ?><span><?php echo $_SESSION['message'];?></span> 
        <a href="manager.php?close-message=1">close</a>
        <?php
     }
?>
     <h2>subject</h2>
     <button onclick="location.href='manager.php?subject-action=insert'">Register New subject</button>
     <div class="table-wrapper">
          <table class="table-center">
               <tr class="row-firt">
                    <td>subject ID</td>
                    <td>subject Name</td>
                    <td>Credits</td>
               </tr>
               <?php
                    while($row_subj_1 = $sql_subj_1->fetch_assoc()){
               ?>
               <tr>
                     <td>
                          <a href="manager.php?subject-id=<?php echo $row_subj_1['ID'] ?>&subject-action=update">
                               <?php echo $row_subj_1['ID']?>
                          </a>
                     </td>
                     <td>
                          <a href="manager.php?subject-id=<?php echo $row_subj_1['ID'] ?>&subject-action=update">
                               <?php echo $row_subj_1['name'];?>
                          </a>
                     </td>
                     <td>
                          <a href="manager.php?subject-id=<?php echo $row_subj_1['ID'] ?>&subject-action=update">
                               <?php echo $row_subj_1['credits'];?>
                          </a>
                     </td>
               </tr>
               <?php 
                    } 
               ?>
          </table>
     </div>
<?php
}else if($action =='insert'){
?>
      <button onclick="location.href='manager.php?subject-action=list'">Back</button>
     <h2>Register New subject</h2> 
     <form action="manager.php" method="post">
          <label for="subject-id">subject ID</label><br>
          <input class="input-1" type="text" name="subject-id" placeholder="subject id"><br>
          <label for="subject-name">subject Name</label><br>
          <input class="input-1" type="text" name="subject-name" placeholder="subject Name"><br>
          <label for="subject-credits">Credit</label><br>
          <input class="input-1" type="number" min="1" max="6" name="subject-credits" placeholder="Num Credits"><br>
          <input class="btn-submit" type="submit" name="subject-register" value="Register">
     </form>
<?php
//UPDATE
}else if($action =='update'){
     if(isset($_GET['subject-id']))
     $_SESSION['subjectID'] = $_GET['subject-id'];
     $sql_sbj_2 = $subject->select_class( $_SESSION['subjectID']);
     $sql_sbj_3 = $subject->select_id( $_SESSION['subjectID']);
     $row_sbj_3 = $sql_sbj_3->fetch_assoc();
?>
     <button onclick="location.href='manager.php?subject-action=list'">Back</button>
     <h2>Course</h2>
     <span>Subject ID : <?php echo  $row_sbj_3['ID'] ?> </span><br>
     <span>Subject Name : <?php echo  $row_sbj_3['name'] ?></span><br>
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
                         <a href="manager.php?&subject-action=class-list">
                              <?php echo $row_sbj_2['ID']?>
                         </a> 
                    </td>
                    <td>
                         <a href="manager.php?&subject-action=class-list">
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
     <button onclick="location.href='manager.php?subject-delete=delete&delete-id=<?php echo  $row_sbj_3['ID'] ?>'">Delete this Subject</button>       
     <!--        ADD NEW COURSE          -->

     <h2> Add new Course</h2>
     <form action="manager.php" method="post">
          <input type="hidden" name="course-subjectID" value="<?php echo $_SESSION['subjectID'] ?>">
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
      <button onclick="location.href='manager.php?subject-action=update'">Back</button>
     <h2>Course</h2>
     <span>Subject ID : CO1003</span><br>
     <span>Subject Name : Cơ sở dữ liệu</span><br>
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


