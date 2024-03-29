<?php

session_start();
require('Database.php');
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
$student_lists = $crud->read('students_list');

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    if(isset($_GET['student_id']) && $_GET['student_id'] > 0){
        $crud->delete("users", ['id'=> $_GET['student_id']]);
        header("Location: students-list.php");
    }
}

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
            <!-- <span class="ms-3 color role-2"><?= $user['role'] ?></span>  -->
            <a class="ms-3 btn btn-warning btn-2" href="?action=logout">Logout</a>
        
        </div>
    </div>
</div>
</div>

    <div class="container  bg-color p-5 rounded">
        <a href="create-student-list.php" class="create-btn btn btn-primary"> + Student List</a>
        <?php  if(count($student_lists) > 0) {?>
            <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <tr>
                    <th class="color">#</th>
                    <th class="color">Name</th>
                    <th></th>
                </tr>
                <?php foreach($student_lists as $list){ ?>
                    <tr>
                        <td class="color"><?= $list['id'] ?></td>
                        <td class="color"><?= $list['title'] ?></td>
                        <td class="">
                            <a href="update-student-list.php?id=<?= $list['id'] ?>" class="btn-4 update btn btn-sm btn-danger">Update</a>
                            <a href="?action=delete&id=<?= $list['id'] ?>" onclick="return confirm('Are you sure!')"  class="btn-4 delete btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
            </table>
            </div>
        <?php } else{ ?>
            <p class="mt-4">0 Student lists</p>
        <?php } ?>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>