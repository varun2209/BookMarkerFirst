 <?php
    function downloadFile() {
        
        $file = 'upload/' . $_SESSION['UID'] . '/' . 'Result.html';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: text/html; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
        }
        
    }
?> 