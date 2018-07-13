<?php
session_start(); //Session wird gestartet
require_once ('config.inc.php');
$userid = $_SESSION['user'];
$fullpath ='/home/tb123/public_html';
$upload_ordner = '/cleo/uploads/';
$new_path = $fullpath.$upload_ordner;

if(isset($_GET['delete'])) {
    $dateiname = $_GET['delete'];

    $statement = $db->prepare('SELECT * FROM Datei WHERE dateiname=? AND OwnerID=?');
    $statement->bindParam(1, $dateiname);
    $statement->bindParam(2, $userid);
    $statement->execute();
    var_dump($statement->fetch(), $userid);


    $statement = $db->prepare('DELETE FROM Datei WHERE dateiname=? AND OwnerID=?');
    $statement->bindParam(1, $dateiname);
    $statement->bindParam(2, $userid);
    $delete = $statement->execute();
    if ($delete !== false)
        unlink($new_path . $dateiname);
    if (isset($_GET['ordnerid'])) { //Überpüfung ob OrdnerID gesetzt wurde
        header('Location: hauptseite.php?ordnerid=' . $_GET['ordnerid']); //falls gesetzt wieder angefügt
    } else {
        header('Location: hauptseite.php'); //weiterleitung auf Hauptseite
    }
}