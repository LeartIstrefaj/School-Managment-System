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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container my-3">
        <div class="d-flex justify-content-between h-100 align-items-center">
            <div class="logo">
            <a href="dashboard.php"><img src="img/logo.png" alt=""></a>
            </div>
            <div class="profile">
                <p><?= $_SESSION['email'] ?>
                <span><?= $user['role'] ?></span>
                <a href="?action=logout">Logout</a>
                </p>
            </div>
        </div>
    </div>

    <?php  if($user['role'] == "admin") { ?>
    <div class="container d-flex justify-content-between">
        <div class="card w-100 mx-3">
            <div class="card-body">
                <p><?= $students ?> Student<?= ($students > 1) ? 's' : ''?></p>
            <a href="students.php" class="btn btn-outline-danger">Details</a>
            </div>
        </div>

        <div class="card w-100 mx-3">
            <div class="card-body">
                <p><?= $professors ?> Professor<?= ($professors > 1) ? 's' : ''?></p>
            <a href="professors.php" class="btn btn-outline-danger">Details</a>
            </div>
        </div>
        <div class="card w-100 mx-3">
            <div class="card-body">
                <p><?= $semesters ?> Semester<?= ($semesters > 1) ? 's' : '' ?></p>
            <a href="semesters.php" class="btn btn-outline-danger">Details</a>
            </div>
        </div>
        <div class="card w-100 mx-3">
            <div class="card-body">
                <p><?= $subjects ?> Subject<?= ($subjects > 1) ? 's' : '' ?></p>
            <a href="subjects.php" class="btn btn-outline-danger">Details</a>
            </div>
        </div>
        <div class="card w-100 mx-3">
            <div class="card-body">
                <p>0 Student Lists</p>
            <a href="" class="btn btn-outline-danger">Details</a>

            </div>
        </div>
    </div>
    <?php } ?>



    <?php  if($user['role'] == "professor") { ?>
    <div class="container d-flex justify-content-between">
        <div class="card w-100 me-4">
            <div class="card-body">
                <p>0 Semesters</p>
            <a href="" class="btn btn-outline-danger">More</a>

            </div>
        </div>

        <div class="card w-100 ms-4">
            <div class="card-body">
                <p>0 Student Lists</p>
            <a href="" class="btn btn-outline-danger">More</a>

            </div>
        </div>
    </div>
    <?php } ?>


    <?php  if($user['role'] == "student") {?>
    <div class="container d-flex justify-content-between">
        <div class="card w-100 me-4">
            <div class="card-body">
               <p> 0 Subjects</p>
            <a href="" class="btn btn-outline-danger">More</a>
            </div>
        </div>
    </div>
    <?php } ?>
</body>
</html>