<?php
session_start();
require_once ('config.inc.php');
$userid = $_SESSION['user'];
$fullpath ='/home/tb123/public_html';
$upload_ordner = '/cleo/uploads/';
$new_path = $fullpath.$upload_ordner;

if(isset($_GET['delete'])) {
    $dateiname = $_GET['delete'];
    $statement = $db->prepare('DELETE * FROM Datei WHERE dateiname=? AND OwnerID=?');
    $statement->bindParam(1, $dateiID);
    $statement->bindParam(2, $userid);
    $delete = $statement->execute();
    if ($delete !== false)
        unlink($new_path . $dateiname);
}
