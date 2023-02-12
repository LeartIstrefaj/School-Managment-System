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
$semesters = $crud->read('semester');


if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $id = $_POST['id'];
    $crud->update('semester', ['title' => $title],['id'=> $id]);
    header("Location: semesters.php");

}

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $semester = $crud->read('semester', ['id'=> $_GET['id']])[0];
        $title = $semester['title'];
        // header("Location: semesters.php");
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $crud->delete($_GET['id']);
        header("Location: semesters.php");
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
        <?php  if(count($semesters) > 0) {?>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>No.semesters</th>
                    <th></th>
                </tr>
                <?php foreach($semesters as $semester){ ?>
                    <tr>
                        <td><?= $semester['id'] ?></td>
                        <td><?= $semester['title'] ?></td>
                        <td>
                            <a href="?action=edit&id=<?= $semester['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="?action=delete&id=<?= $semester['id'] ?>" onclick="return confirm('Are you sure!')"  class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
            </table>
            </div>
        <?php } else{ ?>
            <p>0 Semesters</p>
        <?php } ?>
    </div>

    <!-- Update modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <form action="<?= $_SERVER['PHP_SELF']  ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="<?= (!empty($title)) ? $title : "" ?>" />

                    </div>
              
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />   
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>