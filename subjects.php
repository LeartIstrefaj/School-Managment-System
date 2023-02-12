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
$subjects = $crud->read('subjects');

$semesters = $crud->read('semester');
$professors = $crud->read('users',['role'=> 'professor']);
 
if(isset($_POST['create_btn'])){
    $title = $_POST['title'];
    $professor_id = $_POST['professor_id'];
    $semester_id = $_POST['semester_id'];
    $crud->create('subjects', ['title' => $title, 'professor_id' => $professor_id, 'semester_id' => $semester_id]);
    header("Location: subjects.php");

}

if(isset($_POST['update_btn'])){
    $title = $_POST['title'];
    $professor_id = $_POST['professor_id'];
    $semester_id = $_POST['semester_id'];
    $crud->update('subjects', ['title' => $title, 'professor_id' => $professor_id, 'semester_id' => $semester_id],['id'=> $_POST['id']]);
    header("Location: subjects.php");
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

    <div class="container bg-color p-5 rounded">
    <button type="button" class="create-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Subject</button>
        <div class="">
        <?php  if(count($subjects) > 0) {?>
            <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <tr>
                    <th class="color">#</th>
                    <th class="color">Name</th>
                    <th class="color"></th>
                </tr>
                <?php foreach($subjects as $subject){ ?>
                    <tr>
                        <td class="color"><?= $subject['id'] ?></td>
                        <td class="color"><?= $subject['title'] ?></td>
                        <td>
                            <a href="?action=edit&id=<?= $subject['id'] ?>" class="btn update  btn-sm btn-primary">Edit</a>
                            <a href="?action=delete&id=<?= $subject['id'] ?>" onclick="return confirm('Are you sure!')"  class=" btn delete btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
            </table>
            </div>
        <?php } else{ ?>
            <p class="mt-4">0 Subjects</p>
        <?php } ?>
    </div>

    <!-- Create modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content bg-color">
                <form action="<?= $_SERVER['PHP_SELF']  ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Create/add subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Subject</label>
                        <input type="text" name="title" class="form-control" id="title" /> 
                    </div>
                    <div class="mb-3">
                        <label for="semester_id" class="form-label">Semester</label>
                        <select type="text" name="semester_id" class="form-control" id="semester_id">
                            <option value="">Select semester</option>
                            <?php if(count($semesters)) {
                                 foreach ($semesters as $semester) {
                                    ?>
                                    <option value="<?= $semester['id'] ?>"><?= $semester['title'] ?></option>
                                <?php 
                                    } 
                                }
                                ?>
                        </select> 
                    </div>
                    <div class="mb-3">
                        <label for="professor_id" class="form-label">Professor</label>
                        <select name="professor_id" class="form-control" id="professor_id">
                            <option value="">Select professor</option>
                            <?php if(count($professors)) {
                                 foreach ($professors as $professor) {
                                    ?>
                                    <option value="<?= $professor['id'] ?>"><?= $professor['name']." ".$professor['surname'] ?></option>
                                <?php 
                                    } 
                                }
                                ?>
                        </select>
                    </div>
              
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create_btn" class="btn create btn-primary">Create</button>
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
                    <h5 class="modal-title" id="editModal">Update subjects</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Subject</label>
                        <input type="text" name="title" class="form-control" id="title" /> 
                    </div>

                    <div class="mb-3">
                        <label for="semester_id" class="form-label">Semester</label>
                        <select type="text" name="semester_id" class="form-control" id="semester_id">
                            <option value="">Select semester</option>
                            <?php if(count($semesters)) {
                                 foreach ($semesters as $semester) {
                                    ?>
                                    <option value="<?= $semester['id'] ?>"><?= $semester['title'] ?></option>
                                <?php 
                                    } 
                                }
                                ?>
                        </select> 
                    </div>
                    <div class="mb-3">
                        <label for="professor_id" class="form-label">Professor</label>
                        <select name="professor_id" class="form-control" id="professor_id">
                            <option value="">Select professor</option>
                            <?php if(count($professors)) {
                                 foreach ($professors as $professor) {
                                    ?>
                                    <option value="<?= $professor['id'] ?>"><?= $professor['name']." ".$professor['surname'] ?></option>
                                <?php 
                                    } 
                                }
                                ?>
                        </select>
                    </div>
              
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
                    <button type="submit" name="update_btn" class="btn update btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>