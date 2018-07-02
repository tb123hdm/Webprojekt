<?php
session_start();
require_once ('config.inc.php');
$userid = $_SESSION['user'];

if (isset($_GET['userid'])){
    $userid=$_GET['userid'];
}

if(isset($_GET['delete'])) {
    $dateiID = $_GET['delete'];
    $statement = $db->prepare('DELETE FROM Freigabe WHERE DateiID=? AND UserID=?');
    $statement->bindParam(1, $dateiID);
    $statement->bindParam(2, $userid);
    $delete = $statement->execute();

    if (isset($_GET['ordnerid'])) { //Überpüfung ob OrdnerID gesetzt wurde
        header('Location: hauptseite.php?ordnerid=' . $_GET['ordnerid']); //falls gesetzt wieder angefügt
    } else {
        header('Location: hauptseite.php');
    }
}

