 <?php
    session_start();
    $dbLink = new mysqli('localhost', 'root', '', 'bookmarksorter');
    if (mysqli_connect_errno()) {
        die("MySQL connection failed: " . mysqli_connect_error());
    }
    $username = $_SESSION['UID'];
    $sql      = "SELECT `id`, `name`, `mime`, `size`, `created`, `download_count`, `downloaded_at` FROM `resultfile` WHERE `UserName`='{$username}'";
    $result   = $dbLink->query($sql);
    echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BookMarkSorter</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
</head>
<body>
<div class="container">
<div class="row">
<br><br><br>
<div class="col-sm-6 col-md-12 col-md-offset-0 ">';
    if ($result) {
        if ($result->num_rows == 0) {
            echo '<br><br><br><br><br><br><br><br><h4 class="text-center">There are no files left.<b>&nbsp;</b><b>&nbsp;</b><b>&nbsp;</b><a href="fileWindow.html"  class="btn btn-info">Upload more</a></h4><hr><h4 class="text-center"><a href="logout.php" class="btn btn-info">Logout </a></h4>';
        } else {
            echo '<h4 class="text-center">File summay..</h4><hr>';
            echo '<table width="100%">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Created At</b></td>
                    <td><b>Downloads</b></td>
                    <td><b>Downloaded At</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['created']}</td>
                    <td>{$row['download_count']}</td>
                    <td>{$row['downloaded_at']}</td>
                    <td><a href='get_file.php?id={$row['id']}'>Download</a></td>
                    <td><a href='delete_file.php?id={$row['id']}'>Delete</a></td>
                </tr>";
            }
            
            echo '</table>';
            echo '<hr><h4><a href="ProjectIndex.html"  class="btn btn-info">Upload more</a></h4>';
        }
        
        $result->free();
    } else {
        echo 'Error! SQL query failed:';
        echo "<pre>{$dbLink->error}</pre>";
    }
    
    $dbLink->close();
    echo '</div></div></div></div></body></html>';
?> 