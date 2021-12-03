
<?php 
    //SESSION-----------------------------
    //CALL CLASS----------------------------
    $department = new Department();
    $sql_1 = $department->select();
    $action = 'list';
    if($_SERVER['REQUEST_METHOD']=='POST'){
         if(isset($_POST['Department-register'])=='Register'){
               $departmentName_post = $_POST['department-name'];
               $_SESSION['message'] = $department->insert($departmentName_post);
               $_POST['Department-register'] =='done';
               header('location:manager.php');
         }
         if(isset($_POST['Department-update'])=='Update'){
               $departmentName_post = $_POST['department-name'];
               $departmentID_post = $_POST['department-id'];
               $_SESSION['message'] = $department->update($departmentName_post,$departmentID_post);
               $_POST['Department-update'] =='done';
               header('location:manager.php');
          }   
    }

     if(isset($_GET['department-action']))
     {
          $action = $_GET['department-action'];
     };

     if($action =='close' || $action =='list' || $action == 'delete'){
          if(isset($_GET['close-message'])=='1') unset($_SESSION['message']);
          if(isset($_SESSION['message'])){
             ?> <span><?php echo $_SESSION['message'];?></span> 
             <a href="manager.php?close-message=1">close</a>
             <?php
          }
       
     ?>
          <h2>Department</h2>
          <button onclick="location.href='manager.php?department-action=insert'">Register New Department</button>
          <div class="table-wrapper">
               <table class="table-center">
                    <tr class="row-firt">
                         <td>Department No</td>
                         <td>Department Name</td>
                         <td></td>
                    </tr>
                         <?php while($row_1 = $sql_1->fetch_assoc()){ ?>
                    <tr>
                         <td>
                              <a href="manager.php?department-id=<?php echo $row_1['ID'] ?>&department-name=<?php echo $row_1['name'] ?>&department-action=update">
                                   <?php echo $row_1['ID'] ?>
                              </a>
                         </td>
                         <td>
                              <a href="manager.php?department-id=<?php echo $row_1['ID'] ?>&department-name=<?php echo $row_1['name'] ?>&department-action=update">
                                   <?php echo $row_1['name'] ?>
                              </a> 
                         </td>
                         <td></td>
                    </tr>
                    <?php } ?>
               </table>
          </div>
     <?php
     }else if($action =='insert'){
     ?>
          <h2>Register New Department</h2>
          <button onclick="location.href='manager.php?department-action=list'">Back</button>
          <form action="manager.php" method="post">
               <label for="department-name">Department Name</label><br>
               <input class="input-1" type="text" name="department-name" placeholder="please type Department Name"><br>
               <input class="btn-submit" type="submit" name="Department-register" value="Register">
          </form>
     <?php
     }else if($action =='update'){
          $departmentID = $_GET['department-id'];
          $departmentName = $_GET['department-name'];
     ?>
          <button onclick="location.href='manager.php?department-action=list'">Back</button>
          <h2>Department</h2>
          <span>DepartmentID : <?php echo $departmentID ?> </span><br>
          <span>DepartmentName : <?php echo $departmentName ?></span><br>
          <h2> UPDATE Department</h2>
          <form action="manager.php" method="post">
               <input type="hidden" value="<?php echo $departmentID ?>" name="department-id">
               <label for="department-name">Department Name</label><br>
               <input class="input-1" type="text" name="department-name" placeholder="please type Department Name"><br>
               <input class="btn-submit" type="submit" name="Department-update" value="Update">
          </form>
          <button onclick="location.href='manager.php?department-action=delete&department-id=<?php echo $departmentID?>'">Delete this Department</button>
     <?php
     }
     ?>

