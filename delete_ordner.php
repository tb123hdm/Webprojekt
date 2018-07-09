<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}
if(isset($_GET['aktuellerordner'])){
    $aktuellerordner=$_GET['aktuellerordner'];
}
else $aktuellerordner = NULL;

$loescheUnterordner = function($id) use ($db, $userid, &$loescheUnterordner) {
    $statement=$db->prepare('DELETE FROM Ordner WHERE ID=? AND OwnerID=?'); //Überprüfung ob uns der Ordner gehört
    $statement->bindParam(1, $id);
    $statement->bindParam(2, $userid);
    $statement->execute();

    $statement=$db->prepare('DELETE FROM Datei WHERE OrdnerID=? AND OwnerID=?');
    $statement->bindParam(1, $id);
    $statement->bindParam(2, $userid);
    $statement->execute();

    $statement=$db->prepare('SELECT * FROM Ordner WHERE ParentID=? AND OwnerID=?');
    $statement->bindParam(1, $id);
    $statement->bindParam(2, $userid);
    $statement->execute();

    if($statement->rowCount()>0) {
        foreach($statement->fetchAll() as $ergebnis) { //für jeden Unterordner der gefunden wurde, soll die Funtkion loescheUnterordner ausgeführt werden
            $loescheUnterordner($ergebnis['ID']);
        }

    }
};
$loescheUnterordner($_GET['ordnerid']);
if (isset($_GET['aktuellerordner'])) {
    header('Location: hauptseite.php?ordnerid=' . $_GET['aktuellerordner']);
} else {
    header('Location: hauptseite.php');
}
?>