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
function getFieldFromCollection($field, $collection){
    $fields = [];
    foreach($collection as $item){
        $fields[] = $item[$field];
    }
    return $fields;
}

$db = new Database($db_host,$db_user,$db_password);
$crud = new CRUD($db);
$subjects = $crud->read('subjects');
$professors = $crud->read('users',['role'=> 'professor']);
$students = $crud->read('users',['role'=> 'student']);


$student_list = $crud->read('students_list',['id'=> $_GET['id']])[0];
$title = $student_list['title'];
$subject_id = $student_list['subject_id'];
$professor_id = $student_list['professor_id'];
$std_list_students = $crud->read('student_student_list',['student_list_id' => $student_list['id']]);

$db_students = getFieldFromCollection('student_id',$std_list_students);

if(isset($_POST['submit'])){
    $form_title = $_POST['title'];
    $form_subject_id = $_POST['subject_id'];
    $form_professor_id = $_POST['professor_id'];
    $form_students = $_POST['students'];
    $new_students = [];

    foreach($form_students as $student){
        if (in_array(!$student,$db_students)) {
            $new_students[] = $student;
        }
        
    }
    print_r($db_students);
}



// if(isset($_POST['submit'])){
//     $title = isset($_POST['title']) ? $_POST['title'] : '';
//     $subject_id = isset($_POST['subject']) ? $_POST['subject'] : '';
//     $professor_id = isset($_POST['professor']) ? $_POST['professor'] : '';
 
//     $crud->create('students_list',['title'=> $title, 'subject_id' => $subject_id, 'professor_id' => $professor_id]);
    
//     $student_list = $crud->read('students_list');
//     $student_list_id = $student_list[count($student_list) - 1][0];
 
//      if(is_array($_POST['students'])){
//          foreach($_POST['students'] as $student){
//              $crud->create('student_student_list',['student_id'=> $student, 'student_list_id' => $student_list_id]);
//          }
//      }
//     header("Location: students-list.php");
//  }
 


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
        <a href="students-list.php" class="create-btn btn btn-primary"> Back</a>
        <form action="" method="POST">
            <div class="row mt-4">
                <div class="col-lg-12 col-md-12 mb-3">
                    <div class="form-group"></div>
                    <input type="text" name="title" id="title" class="form-control" value="<?= $title ?>" placeholder="Title:">
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="form-group"></div>
                    <select name="subject" id="subject" class="form-control" placeholder="Subject:">
                            <option value="">Select subject</option>
                            <?php if(count($subjects)) {
                                 foreach ($subjects as $subject) {
                                    ?>
                                    <option value="<?= $subject['id'] ?>"<?php if($subject_id == $subject['id']) echo 'selected'; ?>><?= $subject['title'] ?></option>
                                <?php 
                                    } 
                                }
                                ?>
                    </select>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="form-group"></div>
                    <select name="subject" id="subject" class="form-control" placeholder="Subject:">
                            <option value="">Select professor</option>
                            <?php if(count($professors)) {
                                 foreach ($professors as $professor) {
                                    ?>
                                    <option value="<?= $professor['id'] ?>"<?php if($professor_id == $professor['id']) echo 'selected'; ?>><?= $professor['name']." ".$professor['surname'] ?></option>
                                <?php 
                                    } 
                                }
                                ?>
                    </select>
                </div>

                <div class="col-lg-12 col-md-12 mt-4">
                    <p class="color">Students</p>
                    <?php if(count($students)) {
                        echo "<table class='table table-bordered'>";
                                 foreach ($students as $student) {
                     ?>
                                    <tr>
                                        <td><label class="color" for="<?= $student['name']. "" .$student['surname'] ?>"><?= $student['name']. "" .$student['surname'] ?></label></td>
                                        
                                        <td>
                                            <input type="checkbox" name="students[]" id="<?= $student['name']."".$student['surname'] ?>" value="<?= $student['id'] ?>" <?php if(in_array($student['id'], $db_students)) echo 'checked';  ?> />
                                        </td>
                                    </tr>
                                <?php 
                                    } 
                                    echo "</table>";
                                }
                                ?>
                </div>
                <div class="col-lg-12 col-md-12 col">
                    <button type="submit" name="submit" class="create-btn btn btn-primary btn-sm">Submit</button>
                </div>
            </div> 
        </form>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>