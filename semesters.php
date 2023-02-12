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

if(isset($_POST['create_btn'])){
    $title = $_POST['title'];
    $crud->create('semester', ['title' => $title]);
    header("Location: semesters.php");
}

if(isset($_POST['update_btn'])){
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
        $crud->delete('semester',['id'=> $_GET['id']]);
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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-color-2">
    
    <!-- -->
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

    
    <div class="container bg-color p-5 rounded">
        
    <button type="button" class="create-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Semester</button>
        <a href="?action=create"></a>
        <?php  if(count($semesters) > 0) {?>
            <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <tr>
                    <th class="color">#</th>
                    <th class="color">No.semesters</th>
                    <th class="color"></th>
                </tr>
                <?php foreach($semesters as $semester){ ?>
                    <tr>
                        <td class="color"><?= $semester['id'] ?></td>
                        <td class="color"><?= $semester['title'] ?></td>
                        <td>
                            <a href="?action=edit&id=<?= $semester['id'] ?>" class=" update btn btn-sm btn-primary">Edit</a>
                            <a href="?action=delete&id=<?= $semester['id'] ?>" onclick="return confirm('Are you sure!')"  class="btn-4 delete btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
            </table>
            </div>
        <?php } else{ ?>
            <p class="mt-4">0 Semesters</p>
        <?php } ?>
    </div>

    <!-- Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content bg-color">
                <form action="<?= $_SERVER['PHP_SELF']  ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Create/add semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Semester</label>
                        <input type="text" name="title" class="form-control" id="title" />
                    </div>
              
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create_btn" class="btn-4 create btn btn-primary">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content bg-color">
                <form action="<?= $_SERVER['PHP_SELF']  ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Update semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Semester</label>
                        <input type="text" name="title" class="form-control" id="title" value="<?= (!empty($title)) ? $title : "" ?>" />

                    </div>
              
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />   
                    <button type="submit" name="update_btn" class="btn-4 update btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>