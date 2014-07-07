<?php
    session_start();
    
    include 'reArray.php';
    include 'htmlBookmarkFileMaker.php';
	include 'add_file.php';
    include 'cleanup.php';
    
    $_SESSION['fileCount'] = 0;
    $sessionID             = $_SESSION['UID'];
    $userDirectory         = 'upload/' . $sessionID;
    
    if (!file_exists($userDirectory)) {
        mkdir($userDirectory, 0777, true);
    }
    
    fixFilesArray($_FILES['userfile']);
    
    foreach ($_FILES['userfile'] as $position => $file) {
        //var_dump($file);
        if ($file["error"] > 0) {
            echo "Error: " . $file["error"] . "<br>";
        } else {
            if (file_exists($userDirectory . "/" . $_SESSION['fileCount'] . $file["name"])) {
                echo $file["name"] . " already exists. <br>";
            } else {
                move_uploaded_file($file["tmp_name"], $userDirectory . "/" . $_SESSION['fileCount'] . $file["name"]);
                echo "<br>";
                echo "<br>Stored in: " . $userDirectory . "/" . $_SESSION['fileCount'] . $file["name"];
                $_SESSION['fileCount']++;
                echo "<br>";
            }
        }
    }
    
    sortandmerge();
    downloadFile();
	addFileToDB();
    cleanupDirectory();
    
?>