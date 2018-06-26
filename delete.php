<?php
session_start();
require_once ('config.inc.php');
$userid = $_SESSION['user'];

if(isset($_POST['delete'])) {
    $dateiID = '';
    $statement = $db->prepare('SELECT dateiname FROM Datei WHERE ID=?');
    $statement->bindParam(1, $DateiID);
    $statement->execute();
    $dateiname=$statement->fetch(PDO::FETCH_OBJ);
    unlink($dateiname);
    $statement = $db->prepare('DELETE * FROM Datei WHERE ID=?');
    $statement->bindParam(1, $DateiID);
    $statement->execute();
}