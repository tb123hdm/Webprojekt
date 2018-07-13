<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}

//Definition der Funktion loescheUnterordner

$loescheUnterordner = function($id) use ($db, $userid, &$loescheUnterordner) { //neue Funktion definieren, welcher der Parameter $id übergeben wird, startID, Ergebnis löscheUnterordner hängt von $id ab
    $statement=$db->prepare('DELETE FROM Ordner WHERE ID=? AND OwnerID=?'); //Überprüfung ob uns der Ordner gehört, Ordner löschen, die mir gehören
    $statement->bindParam(1, $id);
    $statement->bindParam(2, $userid);
    $statement->execute();

    $statement=$db->prepare('DELETE FROM Datei WHERE OrdnerID=? AND OwnerID=?'); //Dateien die sich im Ordner befinden/gleiche OrdnerId haben werden gelöscht und mir gehören
    $statement->bindParam(1, $id);
    $statement->bindParam(2, $userid);
    $statement->execute();

    $statement=$db->prepare('SELECT * FROM Ordner WHERE ParentID=? AND OwnerID=?'); //Alle Unterordner der aktuellen ordnerId rausholen, ParentID der ordner = OrdnerID, dann execute,..
    $statement->bindParam(1, $id);
    $statement->bindParam(2, $userid);
    $statement->execute();

    if($statement->rowCount()>0) { //..überprüft, ob es unterordner gibt
        foreach($statement->fetchAll() as $ergebnis) { //für jeden Unterordner der gefunden wurde, soll die Funtkion loescheUnterordner nochmal neu ausgeführt werden, jedes Ergebnis von Fetch wird in ein eigenes $ergebnis eingetragen
            $loescheUnterordner($ergebnis['ID']); //von jedem Ergebnis wird ID geholt und in Funktion loescheUnterordner übergeben/eingesetzt
        }

    }
};
//Funktion wird aufgerfuen und Parameter GET von zu aktuell zu löschendem Ordner wird übergeben, erstmal nur der Oberordner, innherhalb der Funktion die Unterordner, falls vorhanden
$loescheUnterordner($_GET['ordnerid']);
if (isset($_GET['aktuellerordner'])) {
    header('Location: hauptseite.php?ordnerid=' . $_GET['aktuellerordner']); //ordner in dem wir uns befinden und den ich löschen möchte
} else {
    header('Location: hauptseite.php');
}
