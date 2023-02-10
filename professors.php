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
$professors = $user_controller->get('professor');


if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    if(isset($_GET['student_id']) && $_GET['student_id'] > 0){
        $user_controller->delete($_GET['student_id']);
        header("Location: students.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container my-3">
        <div class="d-flex justify-content-between h-100 align-items-center">
            <div class="logo">
                <a href="dashboard.php"><img src="img/logo.png" alt=""></a>
                <!-- <a href="dashboard.php"><h3>School Managment</h3></a> -->
            </div>
            <div class="profile">
                <p><?= $_SESSION['email'] ?>
                <a href="?action=logout">Logout</a>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <?php  if(count($professors) > 0) {?>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Nr.index</th>
                    <th></th>
                </tr>
                <?php foreach($professors as $professor){ ?>
                    <tr>
                        <td><?= $professor['id'] ?></td>
                        <td><?= $professor['name'] ?></td>
                        <td><?= $professor['username'] ?></td>
                        <td><?= (!empty($professor['nr_index'])) ? $professor['nr_index'] : "N/D"  ?></td>
                        <td>
                            <a href="?action=delete&student_id=<?= $professor['id'] ?>" onclick="return confirm('Are you sure!')"  class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
            </table>
            </div>
        <?php } else{ ?>
            <p>0 Professors</p>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>