<?php
session_start();

include 'fileread.php';

$sessionID=session_id();
//$filecount=0;
include 'reArray.php';
fixFilesArray($_FILES['userfile']);
foreach ($_FILES['userfile'] as $position => $file) {
    //var_dump($file);
	if ($file["error"] > 0) {
       echo "Error: " . $file["error"] . "<br>";
    }  else {
    if (file_exists("upload/" .$sessionID. $file["name"])) {
      echo $file["name"] . " already exists. <br>";
    } else {
	//$filecount++;
      move_uploaded_file($file["tmp_name"],
      "upload/" .$sessionID.$file["name"]);
      echo "<br>Stored in: " . "upload/" .$sessionID.$file["name"];
	  sortandmerge();
	  //deletion
	  //unlink("upload/" .$sessionID.$filecount.$file["name"]);
    }
  }
}
?>

