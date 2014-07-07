 <?php
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        if ($id <= 0) {
            die('The ID is invalid!');
        } else {
            $dbLink = new mysqli('localhost', 'root', '', 'bookmarksorter');
            if (mysqli_connect_errno()) {
                die("MySQL connection failed: " . mysqli_connect_error());
            }
            
            $query  = "
            DELETE  
            FROM `resultfile`
            WHERE `id` = {$id}";
            $result = $dbLink->query($query);
            @mysqli_close($dbLink);
        }
        header('Location:list_files.php');
    } else {
        echo 'Error! No ID was passed.';
    }
?> 