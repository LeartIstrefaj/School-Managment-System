<?php

session_start();
require('Database.php');
require('UserController.php');

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
$user_controller = new UserController($db);
$user = $user_controller->getUserById($_SESSION['user_id']);


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
    <?php  if($user['role'] == "professor") { ?>
    <div class="container my-3">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <h3>School Managment</h3>
            </div>
            <div class="profile">
                <p><?= $_SESSION['email'] ?>
                <a href="?action=logout">Logout</a>
                </p>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-between">
        <div class="card w-100 me-4">
            <div class="card-body">
               <p> 0 Students</p>
            <a href="" class="btn btn-outline-danger">More</a>

            </div>
        </div>

        <div class="card w-100 mx-4">
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
        <div class="container my-3">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <h3>School Managment</h3>
            </div>
            <div class="profile">
                <p><?= $_SESSION['email'] ?>
                <a href="?action=logout">Logout</a>
                </p>
            </div>
        </div>
    </div>
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