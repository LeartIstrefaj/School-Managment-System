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
$professors = $crud->read('users', ['role' => 'professor']);


if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $crud->delete('users',['id' => $_GET['id']]);
        header("Location: professors.php");
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
                    <a class="ms-3 btn btn-warning btn-2" href="?action=logout">Logout</a>
                
                </div>
            </div>
        </div>
        </div>

    <div class="container bg-color p-5 rounded">
        <?php  if(count($professors) > 0) {?>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="color">#</th>
                    <th class="color">Name</th>
                    <th class="color">Email</th>
                    <th class="color">Nr.index</th>
                    <th></th>
                </tr>
                <?php foreach($professors as $professor){ ?>
                    <tr>
                        <td class="color"><?= $professor['id'] ?></td>
                        <td class="color"><?= $professor['name'] ?></td>
                        <td class="color"><?= $professor['username'] ?></td>
                        <td class="color"><?= (!empty($professor['nr_index'])) ? $professor['nr_index'] : "N/D"  ?></td>
                        <td>
                            <a href="?action=delete&id=<?= $professor['id'] ?>" onclick="return confirm('Are you sure!')"  class="btn-4 delete w-100 btn btn-danger">Delete</a>
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