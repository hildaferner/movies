<?php
// since we set error_reporting in our config file (db.php), we should not reuse this code in the files again.
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'insert.php';
// if the only purpose of this file is to have an include to another file, then the code from the other file should just be copied here directly without include. It saves you a file. 
?>
