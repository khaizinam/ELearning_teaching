
<?php 
   
    
    //SESSION-----------------------------
    //CALL CLASS----------------------------
    $sql_2 = $department->select();
    $sql_3 = $lecturer->select();
    $action = 'list';
    if($_SERVER['REQUEST_METHOD']=='POST'){
          if(isset($_POST['lecturer-register'])=='Register'){
               $lecturerID_post = $_POST['lecturer-id'];
               $lecturerfName_post = $_POST['lecturer-fisrt-name'];
               $lecturerlName_post = $_POST['lecturer-last-name'];
               $DepartmentID_post = $_POST['department-id'];
               $_SESSION['message'] = $lecturer->insert($lecturerID_post,$lecturerfName_post,$lecturerlName_post,$DepartmentID_post);
               $_POST['lecturer-register'] =='done';
               header('location:manager.php');
          }
          if(isset($_POST['lecturer-update'])=='Update'){
               $lecturerID_post = $_POST['lecturer-id'];
               $lecturerfName_post = $_POST['lecturer-fisrt-name'];
               $lecturerlName_post = $_POST['lecturer-last-name'];
               $DepartmentID_post = $_POST['department-id'];
               $_SESSION['message'] = $lecturer->update($lecturerID_post,$lecturerfName_post,$lecturerlName_post,$DepartmentID_post);
               $_POST['lecturer-update'] =='done';
               header('location:manager.php');
          }   
     }

     if(isset($_GET['lecturer-action']))
     {
          $action = $_GET['lecturer-action'];
     };
     if($action =='close' || $action =='list' || $action == 'delete'){
          if(isset($_GET['close-message'])=='1') unset($_SESSION['message']);
          if(isset($_SESSION['message'])){
             ?> <span><?php echo $_SESSION['message'];?></span> 
             <a href="manager.php?close-message=1">close</a>
             <?php
          }
     ?>
          <h2>Lecturer</h2>
          <button onclick="location.href='manager.php?lecturer-action=insert'">Register New Lecturer</button>
          <div class="table-wrapper">
               <table class="table-center">
                    <tr class="row-firt">
                         <td>Lecturer Name</td>
                         <td>Lecturer ID</td>
                         <td>Department</td>
                         <td></td>
                    </tr>
                    <?php
                         while($row_3 = $sql_3->fetch_assoc()){
                    ?>
                    <tr>
                         <td>
                              <a href="manager.php?lecturer-id=<?php echo $row_3['lecturerID'] ?>&lecturer-name=<?php echo $row_3['lecturerfName'].' '.$row_3['lecturerlName'] ?>&lecturer-action=update">
                                   <?php echo $row_3['lecturerfName'].' '.$row_3['lecturerlName'] ?>
                              </a>
                         </td>
                         <td>
                              <a href="manager.php?lecturer-id=<?php echo $row_3['lecturerID'] ?>&lecturer-name=<?php echo $row_3['lecturerfName'].' '.$row_3['lecturerlName'] ?>&lecturer-action=update">
                                   <?php echo $row_3['lecturerID'] ?>
                              </a>
                         </td>
                         <td>
                              <a href="manager.php?lecturer-id=<?php echo $row_3['lecturerID'] ?>&lecturer-name=<?php echo $row_3['lecturerfName'].' '.$row_3['lecturerlName'] ?>&lecturer-action=update">
                                   <?php echo $row_3['DepartmentName'] ?>
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
          <h2>Register New Lecturer</h2>
          <button onclick="location.href='manager.php?lecturer-action=list'">Back</button>
          <form action="manager.php" method="post">
                <label for="lecturer-id">Lecturer ID</label><br>
               <input class="input-1" type="number" name="lecturer-id" placeholder="please type Lecturer ID"><br>
               <label for="lecturer-fisrt-name">Lecturer Firt Name</label><br>
               <input class="input-1" type="text" name="lecturer-fisrt-name" placeholder="please type Lecturer Name"><br>
               <label for="lecturer-last-name">Lecturer Last Name</label><br>
               <input class="input-1" type="text" name="lecturer-last-name" placeholder="please type Lecturer Name"><br>
               <label for="lecturer-name">Department</label><br>
               <select name="department-id">
                    <option value="none">not choose</option>
                    <?php
                         while($row_2 = $sql_2->fetch_assoc()){
                    ?>
                              <option value="<?php echo $row_2['ID']?>"><?php echo $row_2['name']?></option>
                    <?php 
                         } 
                    ?>
               </select><br>
               <input class="btn-submit" type="submit" name="lecturer-register" value="Register">
          </form>
     <?php
     //UPDATE
     }else if($action =='update'){
          $lecturerID = $_GET['lecturer-id'];
          $lecturerName = $_GET['lecturer-name'];
          $sql_4 = $lecturer->select_id($lecturerID);
          $row_4 = $sql_4->fetch_assoc();
     ?>
          <button onclick="location.href='manager.php?lecturer-action=list'">Back</button>
          <h2>Lecturer</h2>
          <span>Lecturer ID : <?php echo $row_4['lecturerID'] ?> </span><br>
          <span>Lecturer Name : <?php echo $row_4['lecturerfName'].' '.$row_4['lecturerlName'] ?></span><br>
          <span>Department Name : <?php echo $row_4['DepartmentName'] ?></span><br>
          
          <h2> UPDATE Lecturer</h2>
          <form action="manager.php" method="post">
               <input type="hidden" name="lecturer-id" value="<?php echo $row_4['lecturerID']?>">
               <label for="lecturer-fisrt-name">Lecturer Firt Name</label><br>
               <input class="input-1" type="text" name="lecturer-fisrt-name" placeholder="please type Lecturer Name"><br>
               <label for="lecturer-last-name">Lecturer Last Name</label><br>
               <input class="input-1" type="text" name="lecturer-last-name" placeholder="please type Lecturer Name"><br>
               <label for="lecturer-name">Department</label><br>
               <select name="department-id">
                    <option value="none">not choose</option>
                    <?php
                         while($row_2 = $sql_2->fetch_assoc()){
                    ?>
                              <option value="<?php echo $row_2['ID']?>"><?php echo $row_2['name']?></option>
                    <?php 
                         } 
                    ?>
               </select><br>
               <input class="btn-submit" type="submit" name="lecturer-update" value="Update">
          </form>
          <button onclick="location.href='manager.php?lecturer-action=delete&lecturer-id=<?php echo $lecturerID?>'">Delete this Department</button>
     <?php
     }
     ?>

