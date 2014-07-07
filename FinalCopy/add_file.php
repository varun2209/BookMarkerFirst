<?php
function addFileToDB(){
        $dbLink = new mysqli('localhost', 'root', '', 'bookmarksorter');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $name = $dbLink->real_escape_string('ResultFile.html');
        $mime = $dbLink->real_escape_string('text/html; charset=utf-8');
		$file = 'upload/' . $_SESSION['UID'] . '/' . 'Result.html';
        $data = $dbLink->real_escape_string(file_get_contents($file));
        $size = intval(filesize($file));
 
        // Create the SQL query
        $query = "
            INSERT INTO `resultfile` (
                `name`, `mime`, `size`, `data`, `created`, `UserName`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW(), '{$_SESSION['UID']}'
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
}
 
?>
 