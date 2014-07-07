<?php
$old_version = 'upload/Bookmarks';
$fix1 = 'upload/Bookmarks.bak';
$fix2 = 'upload/Bookmarks.bak';

$errors = xdiff_file_merge3($old_version, $fix1, $fix2, 'download/result');
if (is_string($errors)) {
    echo "Rejects:\n";
    echo $errors;
}
?>