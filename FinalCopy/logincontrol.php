 <?php
    $con = mysqli_connect("localhost", "root", "", "bookmarksorter");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    // escape variables for security
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['passcode']);
    
    $sql = "SELECT count(*) FROM UserInfo WHERE UserName='$username' AND Password='$password'";
    
    $result = mysqli_query($con, $sql);
	$count = mysqli_fetch_array($result);
    if ($count[0]!=1) {
        echo false;
    } else {
	    ini_set('session.gc_maxlifetime', 60);
        session_start();
        $_SESSION['UID']      = $username;
        $_SESSION['PASSCODE'] = $password;
        echo "fileWindow.html";
    }
    mysqli_close($con);
?>
