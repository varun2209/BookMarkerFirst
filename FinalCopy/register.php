 <?php
    $con = mysqli_connect("localhost", "root", "", "bookmarksorter");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    // escape variables for security
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['passcode']);
    
    
    $sql = "INSERT INTO UserInfo (UserName, Password)
            VALUES ('$username', '$password')";
    
    if (mysqli_query($con, $sql)) {
        echo "index.php";
    } else {
        echo false;
    }
    
    mysqli_close($con);
?> 