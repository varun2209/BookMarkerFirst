<?php
    session_start();
    if (isset($_SESSION['UID'])) {
        $con = mysqli_connect("localhost", "root", "", "bookmarksorter");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $username = mysqli_real_escape_string($con, $_SESSION['UID']);
        $password = mysqli_real_escape_string($con, $_SESSION['PASSCODE']);
        
        $sql = "SELECT * FROM UserInfo WHERE UserName=$username AND Password=$password";
        
        $result = mysqli_query($con, $sql);
        mysqli_close($con);
        if (!empty($result)) {
            session_start();
            $_SESSION['UID'] = $username;
            header('Location:fileWindow.html');
        }
    } else {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BookMarkSorter</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script src="js/loginForm.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<br><br><br><br><br><br>
<div class="col-sm-6 col-md-4 col-md-offset-4 ">
<h4 class="text-center login-title">Login to continue to BookMarkSorter</h4>
<div class="account-wall">
<form class="form-signin" id="loginform" action="logincontrol.php">
<input type="text" class="form-control" id="username" name="username" placeholder="User Name" required autofocus >
<input type="password" class="form-control" id="passcode" name="passcode" placeholder="Password" required>
<button class="btn btn-success btn-block" type="submit">
Sign in</button>
</form>
</div>
<a href="registerpage.html" class="text-center new-account">Create an account </a>
<div id="result"></div>
</div>
</div>
</div>
</body>
</html>';
    }
?>                 