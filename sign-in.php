<?php 
    session_start();
    require('Database.php');
    $db_host = "mysql:host=localhost;dbname=sms";
    $db_user = "root";
    $db_password = "";
    $db = new Database($db_host,$db_user,$db_password);
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM  `users`";
        $users = $db->select($sql, [$username,$password]);
        $found = false;
        $user_id = null;

        foreach($users as $user){ 
            if($user['username'] == $username &&  $user['password'] == $password){
                $found = true;
                $user_id = $user['id'];
                break;
            }
           
        }
        if($found){
           $_SESSION['loggedin'] = true;
           $_SESSION['email'] = $username;
           $_SESSION['user_id'] = $user_id;
           header("Location: dashboard.php");
        }
        else{
            echo "<script>
            alert('User is not registred!.');
            </script>";
        }
        
            
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
    <!-- section of  Login form-->
    <div class="login-section-1">
        <form class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="myform" onsubmit="return login();">
            <h2 class="title">Login !</h2>
            <div id="error_message"></div>
            <input class="input-control" type="text" name="username" id="username" placeholder="Enter your Email Address">
            <input class="input-control" type="password" name="password" id="password"
                placeholder="Enter your Password">
            <input class="btn" type="submit" id="submit" name="login" value="LOGIN">
            <a href="sign-up.php" class="sign-up-link">Sign Up | Create Account</a>
        </form>
    </div>


    <!-- <script src="js/login.js"></script> -->
    <script src="js/validate.js"></script>
</body>

</html>