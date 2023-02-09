<?php 
    require('Database.php');
    $db_host = "mysql:host=localhost;dbname=sms";
    $db_user = "root";
    $db_password = "";
        $db = new Database($db_host,$db_user,$db_password);
    
    if(isset($_POST['register'])){
        $fullname = $_POST['fullname'];

        $name = explode(" ", $fullname)[0];
        // $surname = explode(" ", $fullname)[1];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        // $password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO `users`(`name`,`username`,`password`,`role`) VALUES (?,?,?,?)";
        $db->query($sql,[$name,$username,$password,$role]);
        header("Location: sign-in.php");
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS-School Managment System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <img id="img-logo" src="img/logo.png" alt="logo">
        </div>
        <nav class="navbar">
            <ul class="navbar-list">
                <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="last nav-link" href="sign-in.php">Sign In</a></li>
            </ul>
        </nav>
    </header>
    <!-- section of  Sign Up form-->
    <div class="login-section-2">
        <form class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST"  id="myform" onsubmit="return signup();">
            <h2 class="title">Sign Up!</h2>
            <div id="error_message"></div>
            <input class="input-control" type="text" name="fullname" id="fistName" placeholder="Enter your Full Name">
            <!-- <input class="input-control" type="text" name="surname" id="lastName" placeholder="Enter your Last Name"> -->
            <input class="input-control" type="email" name="username" id="email" placeholder="Enter your Email Address">
            <input class="input-control" type="password" name="password" id="password"
                placeholder="Enter your Password">
            <select name="role" id="role">
                <option value="professor">Professor</option>
                <option value="student">Student</option>
            </select>
            <input class="btn m-2" type="submit" name="register" value="SIGN UP" id="submit">
            <a href="sign-in.php" class="sign-up-link">Already have an account? Log In</a>
        </form>
    </div>

    <script src="js/validate.js"></script>
</body>

</html>