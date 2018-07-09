<?php
session_start();
require_once ('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}

if(isset($_GET['dateiid'], $_POST['ordnername'])){ //voraussetzung das beides gestezt ist
    $dateiid=$_GET['dateiid'];
    $ordnername=$_POST['ordnername']; //ordnername und dateiID wird übergeben
    $statement=$db->prepare('SELECT * FROM Ordner WHERE ordnername=? and OwnerID=?');
    $statement->bindParam(1,$ordnername);
    $statement->bindParam(2,$userid);
    $ergebnis=$statement->execute();
    if($statement->rowCount()!=0){ //wenn ergebnis nicht falsch ist, existiert unser ornder
        $ordnerid=$statement->fetch()['ID']; //OrdnerID wurde generiert
        $statement=$db->prepare('UPDATE Datei SET OrdnerID=? WHERE ID=?');
        $statement->bindParam(1,$ordnerid);
        $statement->bindParam(2,$dateiid);
        $statement->execute();
        header('Location: hauptseite.php?ordnerid='.$ordnerid);
    }
    else{
        header('Location: hauptseite.php?Fehler=Ordner konnte nicht gefunden werden.'); // wenn Ordner nicht existiert oder nicht gefunden werden kann, dann gehe zurück auf Hauptseite
    }
}
else{
    header('Location: hauptseite.php');
}