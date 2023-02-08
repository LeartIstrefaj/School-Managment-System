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
        <form class="form" action="" method=""  id="myform" onsubmit="return signup();">
            <h2 class="title">Sign Up!</h2>
            <div id="error_message"></div>
            <input class="input-control" type="text" name="fistName" id="fistName" placeholder="Enter your First Name">
            <input class="input-control" type="text" name="lastName" id="lastName" placeholder="Enter your Last Name">
            <input class="input-control" type="email" name="email" id="email" placeholder="Enter your Email Address">
            <input class="input-control" type="password" name="password" id="password"
                placeholder="Enter your Password">
            <input class="btn" type="submit" value="SIGN UP" id="submit">
            <a href="sign-in.php" class="sign-up-link">Already have an account? Log In</a>
        </form>
    </div>

    <script src="js/validate.js"></script>
</body>

</html>