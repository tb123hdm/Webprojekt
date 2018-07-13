<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}

if(isset($_GET['ordnerid'])){
    $ordnerid=$_GET['ordnerid'];
}
else{
    $ordnerid= NULL;
}

if(isset($_POST['ordnername'])) {
    $original_ordnername = $_POST['ordnername'];
    $hochzaehlen="";
    $i=1;
    do{
        $ordnername=$original_ordnername.$hochzaehlen;
        $statement=$db->prepare("SELECT * FROM Ordner WHERE ordnername=? AND OwnerID=?"); //Überprüfung b Name schon existiert und ob Ordner mir gehört
        $statement->bindParam(1,$ordnername);
        $statement->bindParam(2,$userid);
        $statement->execute();
        $hochzaehlen='-'.$i;
        $i++;
    }while($statement->rowCount()!=0); // Solange ein Ergebnis zurück kommt da nicht gleich 0 ist, dann springt er wieder in die while schleife und zählt den Namen weiter hoch

    $statement = $db->prepare("INSERT INTO Ordner (ordnername, ParentID, OwnerID ) VALUES (?, ?, ?)");
    $statement->bindParam(1, $ordnername);
    $statement->bindParam(2, $ordnerid);
    $statement->bindParam(3, $userid);
    $statement->execute();
    if (isset($_GET['ordnerid'])) {
        header('Location: hauptseite.php?ordnerid=' . $_GET['ordnerid']);
    } else {
        header('Location: hauptseite.php');
    }

}

