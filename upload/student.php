
<?php 

    $sql_std_1 = $student->select();
    $sql_std_2 = $department->select();
   //SESSION-----------------------------
   //CALL CLASS----------------------------
  
   $action = 'list';
   if($_SERVER['REQUEST_METHOD']=='POST'){
         if(isset($_POST['student-register'])=='Register'){
              $studentID_post = $_POST['student-id'];
              $studentfName_post = $_POST['student-fisrt-name'];
              $studentlName_post = $_POST['student-last-name'];
              $studentstatus_post = $_POST['student-status'];
              $DepartmentID_post = $_POST['department-id'];
              $_SESSION['message'] = $student->insert($studentID_post,$studentfName_post,$studentlName_post,$DepartmentID_post,$studentstatus_post);
              $_POST['student-register'] =='done';
              header('location:manager.php');
         }
         if(isset($_POST['student-update'])=='Update'){
          $studentID_post = $_POST['student-id'];
          $studentfName_post = $_POST['student-fisrt-name'];
          $studentlName_post = $_POST['student-last-name'];
          $studentstatus_post = $_POST['student-status'];
          $DepartmentID_post = $_POST['department-id'];
          $_SESSION['message'] = $student->update($studentID_post,$studentfName_post,$studentlName_post,$DepartmentID_post,$studentstatus_post);
              $_POST['student-update'] =='done';
              header('location:manager.php');
         }   
    }

    if(isset($_GET['student-action']))
    {
         $action = $_GET['student-action'];
    };
    if($action =='close' || $action =='list' || $action == 'delete'){
         if(isset($_GET['close-message'])=='1') unset($_SESSION['message']);
         if(isset($_SESSION['message'])){
            ?><span><?php echo $_SESSION['message'];?></span> 
            <a href="manager.php?close-message=1">close</a>
            <?php
         }
    ?>
         <h2>Student</h2>
         <button onclick="location.href='manager.php?student-action=insert'">Register New Student</button>
         <div class="table-wrapper">
              <table class="table-center">
                   <tr class="row-firt">
                        <td>Student Name</td>
                        <td>Student ID</td>
                        <td>Department</td>
                        <td>Status</td>
                        <td></td>
                   </tr>
                   <?php
                        while($row_std_1 = $sql_std_1->fetch_assoc()){
                   ?>
                   <tr>
                         <td>
                              <a href="manager.php?student-id=<?php echo $row_std_1['studentID'] ?>&student-name=<?php echo $row_std_1['studentfName'].' '.$row_std_1['studentlName'] ?>&student-action=update">
                                   <?php echo $row_std_1['studentfName'].' '.$row_std_1['studentlName'] ?>
                              </a>
                         </td>
                         <td>
                              <a href="manager.php?student-id=<?php echo $row_std_1['studentID'] ?>&student-name=<?php echo $row_std_1['studentfName'].' '.$row_std_1['studentlName'] ?>&student-action=update">
                                   <?php echo $row_std_1['studentID']; ?>
                              </a>
                         </td>
                         <td>
                              <a href="manager.php?student-id=<?php echo $row_std_1['studentID'] ?>&student-name=<?php echo $row_std_1['studentfName'].' '.$row_std_1['studentlName'] ?>&student-action=update">
                                   <?php echo $row_std_1['DepartmentName']; ?>
                              </a>
                         </td>
                         <td>
                              <a href="manager.php?student-id=<?php echo $row_std_1['studentID'] ?>&student-name=<?php echo $row_std_1['studentfName'].' '.$row_std_1['studentlName'] ?>&student-action=update">
                                   <?php echo $row_std_1['status']; ?>
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
          <button onclick="location.href='manager.php?student-action=list'">Back</button>
         <h2>Register New Student</h2> 
         <form action="manager.php" method="post">
               <label for="student-id">Student ID</label><br>
              <input class="input-1" type="number" name="student-id" placeholder="please type student ID"><br>
              <label for="student-fisrt-name">student Firt Name</label><br>
              <input class="input-1" type="text" name="student-fisrt-name" placeholder="please type student Name"><br>
              <label for="student-last-name">student Last Name</label><br>
              <input class="input-1" type="text" name="student-last-name" placeholder="please type student Name"><br>
              <label for="department-id">Department Choose</label><br>
              <select name="department-id">
                   <option value="none">not choose</option>
                   <?php
                        while($row_std_2 = $sql_std_2->fetch_assoc()){
                   ?>
                             <option value="<?php echo $row_std_2['ID']?>"><?php echo $row_std_2['name']?></option>
                   <?php 
                        } 
                   ?>
              </select><br>
              <label for="student-status">Status</label><br>
              <select name="student-status">
                   <option value="Active">Active</option>
                   <option value="Supended">Supended</option>
                   <option value="Stop study">Stop study</option>
              </select><br>
              <input class="btn-submit" type="submit" name="student-register" value="Register">
         </form>
    <?php
    //UPDATE
    }else if($action =='update'){
         $studentID = $_GET['student-id'];
         $sql_std_4 = $student->select_id($studentID);
         $row_std_4 = $sql_std_4->fetch_assoc();
    ?>
         <button onclick="location.href='manager.php?student-action=list'">Back</button>
         <h2>Student</h2>
         <span>Student ID : <?php echo $row_std_4['studentID'] ?> </span><br>
         <span>Student Name : <?php echo $row_std_4['studentfName'].' '.$row_std_4['studentlName'] ?></span><br>
         <span>Department Name : <?php echo $row_std_4['DepartmentName'] ?></span><br>
         <span>Status : <?php echo $row_std_4['status'] ?></span><br>
         <h2>Student's Course</h2>
         <hr>
         <h2>Semester 212</h2>
         <div class="table-wrapper-sm">
              <table class="table-center">
                   <tr class="row-firt">
                         <td>No</td>
                         <td>subject Name</td>
                         <td>subject ID</td>
                         <td>Course Name</td>
                         <td>credits</td>
                   </tr>
                   <tr>
                         <td>1</td>
                         <td>Hệ Cơ sở dữ liệu</td>
                         <td>CO1003</td>
                         <td>L05</td>
                         <td>3</td>
                   </tr>
                   <tr>
                         <td>2</td>
                         <td>Kiến trúc máy tính</td>
                         <td>CO1045</td>
                         <td>DT05</td>
                         <td>3</td>
                   </tr>
              </table>
          </div>

         <h2> UPDATE Student</h2>
         <form action="manager.php" method="post">
              <input type="hidden" name="student-id" value="<?php echo $row_std_4['studentID']?>">
              <label for="student-fisrt-name">Lecturer Firt Name</label><br>
              <input class="input-1" type="text" name="student-fisrt-name" value="<?php  echo  $row_std_4['studentfName']?>" placeholder="<?php  echo  $row_std_4['studentfName']?>"><br>
              <label for="student-last-name">student Last Name</label><br>
              <input class="input-1" type="text" name="student-last-name" value="<?php  echo  $row_std_4['studentlName']?>" placeholder="<?php  echo  $row_std_4['studentlName']?>"><br>
              <label for="department-id">Department Choose</label><br>
              <select name="department-id">
                   <option value="none">not choose</option>
                   <?php
                        while($row_std_2 = $sql_std_2->fetch_assoc()){
                   ?>
                             <option value="<?php echo $row_std_2['ID']?>"><?php echo $row_std_2['name']?></option>
                   <?php 
                        } 
                   ?>
              </select><br>
              <label for="student-status">Status</label><br>
              <select name="student-status">
                   <option value="Active">Active</option>
                   <option value="Supended">Supended</option>
                   <option value="Stop study">Stop study</option>
              </select><br>
              <input class="btn-submit" type="submit" name="student-update" value="Update">
         </form>
         <button onclick="location.href='manager.php?student-action=delete&student-id=<?php echo $studentID?>'">Delete this Student</button>
    <?php
    }
    ?>

