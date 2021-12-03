
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
}

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
                          <a href="manager.php?subject-id=<?php echo $row_subj_1['subjectID'] ?>&subject-action=update">
                               <?php echo $row_subj_1['ID']?>
                          </a>
                     </td>
                     <td>
                          <a href="manager.php?subject-id=<?php echo $row_subj_1['subjectID'] ?>&subject-action=update">
                               <?php echo $row_subj_1['name'];?>
                          </a>
                     </td>
                     <td>
                          <a href="manager.php?subject-id=<?php echo $row_subj_1['subjectID'] ?>&subject-action=update">
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
   
?>
     <button onclick="location.href='manager.php?subject-action=list'">Back</button>
      <h2>Course</h2>
      <span>Subject ID : CO1003</span><br>
      <span>Subject Name : Cơ sở dữ liệu</span><br>
      <span>Credits : 3</span><br>
     <div class="table-wrapper">
          <table class="table-center">
               <tr class="row-firt">
                    <td>Class ID</td>
                    <td>Class Name</td>
                    <td>Num Student</td>
               </tr>
               <tr>
                     <td>1</td>
                     <td>L05</td>
                     <td>60</td>
               </tr>
               <tr>
                     <td>2</td>
                     <td>L06</td>
                     <td>60</td>
               </tr>
               <tr>
                     <td>3</td>
                     <td>CLC02</td>
                     <td>60</td>
               </tr>
               <tr>
                     <td>102</td>
                     <td>DT01</td>
                     <td>60</td>
               </tr>

          </table>
     </div>














     <h2> UPDATE subject</h2>
     <form action="manager.php" method="post">
         
     </form>
     <button onclick="location.href='manager.php?subject-action=delete&subject-id=<?php echo $subjectID?>'">Delete this subject</button>
<?php
}
?>

