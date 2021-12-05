<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Edu.vn</title>
</head>
<body>
    <div class="container">
        <div class="content d-flex boder-1">
            <div class="left">
                <ul class="menu-1">
                    <li><a href="../index.php" class="home">home</a></li>
                    <li><a href="manager.php?page-direct=Department" class="home">Department</a></li>
                    <li><a href="manager.php?page-direct=Lecturer" class="home">Lecturer</a></li>
                    <li><a href="manager.php?page-direct=Student" class="home">Student</a></li>
                    <li><a href="manager.php?page-direct=subject" class="home">Subject</a></li>
                    <li><a href="manager.php?page-direct=Textbook" class="home">Text book</a></li>
                </ul>
            </div>
            <div class="right">
                <?php
                    include('../func/data_connect.php');
                    $department = new Department();
                    $lecturer = new Lecturer();
                    $student = new Student();
                    $subject = new Subject();
                    $textbook = new Textbook();
                     session_start();
                     if(!isset( $_SESSION['page'])){
                        $_SESSION['page'] ='menu';
                     }
                    
                     if(isset($_GET['page-direct']) && $_GET['page-direct']!=''){
                         $_SESSION['page'] = $_GET['page-direct'];
                     }     
                     if($_SESSION['page'] == 'Department'){
                         include('../upload/department.php');
                     }elseif($_SESSION['page'] == 'Lecturer'){
                         include('../upload/lecturer.php');
                    }
                    elseif($_SESSION['page'] == 'Student'){
                         include('../upload/student.php');
                     }
                     elseif($_SESSION['page'] == 'subject'){
                         include('../upload/subject.php');
                     }elseif($_SESSION['page'] == 'Textbook'){
                         include('../upload/textbook.php');
                     }else{

                     }  
                ?>
            </div>
        </div>
    </div>    
</body>
</html>