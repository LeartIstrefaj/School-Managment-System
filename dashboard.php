<?php

session_start();
require('Database.php');
// require('UserController.php');
require('CRUD.php');

$db_host = "mysql:host=localhost;dbname=sms";
$db_user = "root";
$db_password = "";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("Location: 401.php");
}


if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header("Location: sign-in.php");
}

$db = new Database($db_host,$db_user,$db_password);
$crud = new CRUD($db);
$user = $crud->read('users',['id' => $_SESSION['user_id']])[0];

$students = count($crud->read('users',['role' => 'student'])); 
$professors = count($crud->read('users',['role' => 'professor'])); 
$semesters = count($crud->read('semester')); 
$subjects = count($crud->read('subjects')); 
$std_lists = count($crud->read('students_list')); 



$prof_std_lists = count($crud->read('students_list',['professor_id' => $_SESSION['user_id']])); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-color-2">

    <div class="container my-3">

        <div class="d-flex justify-content-between h-100 align-items-center">
            <div class="logo">
                <a href="dashboard.php"><img src="img/logo-footer.png" alt=""></a>
            </div>
            <div class="row"> 
                <div class="d-flex justify-content-between h-100 align-items-center profile mb-4">
                    <span class="color role"><?= $_SESSION['email']?></span>
                    <span class="ms-3 color role-2"> <?= $user['role'] ?></span> 
                    <a class="ms-3 btn btn-warning btn-2" href="?action=logout">Logout</a>
                
                </div>
            </div>
        </div>
    </div>

    <?php  if($user['role'] == "admin") { ?>
    <div class="container d-flex flex-sm-wrap flex-md-wrap flex-lg-nowrap">
        <div class="bg-color card w-100 mx-3 mb-sm-3 mb-lg-0">
            <div class="card-body">
                <p class="color p-dashboard"><?= $students ?> Student<?= ($students > 1) ? 's' : ''?></p>
            <a href="students.php" class="btn-5 btn ">Details</a>
            </div>
        </div>

        <div class="bg-color card w-100 mx-3 mb-sm-3 mb-lg-0">
            <div class="card-body">
                <p class="p-dashboard"><?= $professors ?> Professor<?= ($professors > 1) ? 's' : ''?></p>
            <a href="professors.php" class="btn-5 btn ">Details</a>
            </div>
        </div>
        <div class="bg-color card w-100 mx-3 mb-sm-3 mb-lg-0">
            <div class="card-body">
                <p class="p-dashboard"><?= $semesters ?> Semester<?= ($semesters > 1) ? 's' : '' ?></p>
            <a href="semesters.php" class="btn-5 btn ">Details</a>
            </div>
        </div>
        <div class="bg-color card w-100 mx-3 mb-sm-3 mb-lg-0">
            <div class="card-body">
                <p class="p-dashboard"><?= $subjects ?> Subject<?= ($subjects > 1) ? 's' : '' ?></p>
            <a href="subjects.php" class="btn-5 btn ">Details</a>
            </div>
        </div>
        <!-- <div class="bg-color card w-100 mx-3 mb-sm-3 mb-lg-0">
            <div class="card-body">
                <p class="p-dashboard"><?= $std_lists ?> Student Lists</p>
            <a href="students-list.php" class="btn-5 btn ">Details</a>

            </div>  
        </div> -->
    </div>
    <?php } ?>



    <?php  if($user['role'] == "professor") { ?>
    <div class="container flex-sm-wrap flex-md-wrap flex-lg-nowrap">
        <div class="row d-flex">
            <div class="col-lg-4 col-sm-12 d-flex">
            <div class="bg-color card card-d w-100 py-3 mb-3 mb-lg-0">
                <div class="card-body col-lg-5">
                    <p class="p-dashboard"><?= $semesters ?> Semester<?= ($semesters > 1) ? 's' : '' ?></p>
                <a href="semesters.php" class="btn-5 btn btn-outline-danger">Details</a>

                </div>
            </div>
            </div>
            <div class="col-sm-12 col-lg-4 d-flex">
            <div class="bg-color card card-d w-100  py-3 mb-sm-3 mb-lg-0">
                <div class="card-body col-lg-5">
                    <p class="p-dashboard"><?= $students ?> All Student<?= ($students > 1) ? 's' : '' ?></p>
                <a href="prof-student.php" class="btn-5 btn btn-outline-danger">Details</a>

                </div>
            </div>
            </div>
        </div>
    </div>
    <?php } ?>


    <?php  if($user['role'] == "student") {?>
    <div class="container flex-sm-wrap flex-md-wrap flex-lg-nowrap">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="bg-color card">
                <div class="card-body">
                <p class="p-dashboard"><?= $subjects ?> Subject<?= ($subjects > 1) ? 's' : '' ?></p>
                    <a href="student-subject.php" class="btn-5 btn btn-outline-danger">List of subjects</a>
                </div>
            </div>
            </div>
            </div>
    </div>
    <?php } ?>

    </div>

    
</body>
</html>