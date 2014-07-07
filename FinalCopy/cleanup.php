 <?php
    function cleanupDirectory() {
        
        $userDirectory = 'upload/' . $_SESSION['UID'];
        for ($i = 0; $i < $_SESSION['fileCount']; $i++) {
            unlink($userDirectory . "/" . $i . "Bookmarks");
        }
        unlink($userDirectory . "/" . "Result.html");
        rmdir($userDirectory);
    }
?> 