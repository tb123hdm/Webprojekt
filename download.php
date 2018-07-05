<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];

//Kommentar den ich löschen muss wieder .. test

$directory = "/home/tb123/public_html/cleo/uploads/";

$mimetypes = array (
    '.doc'=> 'application/msword',
    '.jpeg'=> 'image/jpeg',
    '.jpg'=> 'image/jpg',
    '.png'=> 'image/png',
    '.pdf'=> 'application/pdf',
    '.ppt'=> 'application/mspowerpoint',
);
if(empty($_GET["dateiname"])) //wenn dateiname leer ist, wenn man über URL download.php aufruft
{
    echo "keine Datei zum Download ausgewählt.";
    die();
}
else
{
    $filename=$_GET["dateiname"];
}

$statement=$db->prepare('SELECT * FROM Datei LEFT JOIN Freigabe ON (Freigabe.DateiID=Datei.ID) WHERE (Freigabe=1 OR OwnerID=? OR Freigabe.UserID=?) AND dateiname=?'); //Klammern überflüssig wenn nur OR oder nur AND, alles außerhalb der Klammer muss mitgenommen werden
$statement->bindParam(1,$userid);
$statement->bindParam(2,$userid);
$statement->bindParam(3,$filename);

$statement->execute();

if($statement->rowCount()!=0){

    $filepath=$directory.$filename;
    header("Content-Type:".$mimetype);
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header("Content-Transfer-Encoding: binary ");
    header("Content-Length: ".filesize($filepath));
    readfile($filepath);
}
else{
    header('Location: hauptseite.php');
}
