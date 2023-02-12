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
$students = $crud->read('users',['role' => 'student']);


if(isset($_POST['submit'])){
    $nr_index = $_POST['nr_index'];
    $id = $_POST['student_id'];
    $crud->update('users', ['nr_index' => $nr_index],  ['id' => $id]);
    header("Location: students.php");
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    if(isset($_GET['student_id']) && $_GET['student_id'] > 0){
        $crud->delete("users", ['id'=> $_GET['student_id']]);
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
        <?php  if(count($students) > 0) {?>
            <div class="table-responsive ">
            <table class="table table-bordered">
                <tr>
                    <th class="color">#</th>
                    <th class="color">Name</th>
                    <th class="color">Email</th>
                    <th class="color">Nr.index</th>
                    <th></th>
                </tr>
                <?php foreach($students as $student){ ?>
                    <tr>
                        <td class="color"><?= $student['id'] ?></td>
                        <td class="color"><?= $student['name'] ?></td>
                        <td class="color"><?= $student['username'] ?></td>
                        <td class="color"><?= (!empty($student['nr_index'])) ? $student['nr_index'] : "N/D"  ?></td>
                        <td class="">
                            <a href="?action=edit&student_id=<?= $student['id'] ?>" class=" btn-4 update btn btn-sm btn-primary">Edit</a>
                            <a href="?action=delete&student_id=<?= $student['id'] ?>" onclick="return confirm('Are you sure!')"  class="btn-4 delete btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
            </table>
            </div>
        <?php } else{ ?>
            <p>0 Students</p>
        <?php } ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-color">
                <form action="<?= $_SERVER['PHP_SELF']  ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Update Index no</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nr_index" class="form-label">Index no</label>
                        <input type="text" name="nr_index" class="form-control" id="nr_index" />
                        <input type="hidden" name="student_id" value="<?= $_GET['student_id'] ?>" />    
                    </div>
              
                </div>
                <div class="modal-footer outline-0">
                    <button type="submit" name="submit" class="btn-4 update btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>