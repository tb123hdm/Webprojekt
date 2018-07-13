<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];

//Kommentar den ich löschen muss wieder .. test

$directory = "/home/tb123/public_html/cleo/uploads/"; //hieraus sollen Dateien zum Download genommen werden

$mimetypes = array ( //mimetypes werden in eim assoziativen Array gespeichert -> Schlüssel & Wert Paare
    '.doc'=> 'application/msword',
    '.jpeg'=> 'image/jpeg',
    '.jpg'=> 'image/jpg',
    '.png'=> 'image/png',
    '.pdf'=> 'application/pdf',
    '.ppt'=> 'application/mspowerpoint',
    '.pptx'=> 'application/mspowerpoint',
    '.docx'=> 'application/msword',
    '.pages'=> 'application/applefile',
    '.key'=> 'application/applefile',
    '.mp4'=> 'video/mp4',
    '.mp3'=> 'audio/mp3',
    '.mov'=> 'video/quicktime',

);
if(isset($_GET["dateiname"])) //wenn dateiname leer ist, wenn man über URL download.php aufruft
{
    $filename=$_GET["dateiname"];


$statement=$db->prepare('SELECT * FROM Datei LEFT JOIN Freigabe ON (Freigabe.DateiID=Datei.ID) WHERE (Freigabe=1 OR OwnerID=? OR Freigabe.UserID=?) AND dateiname=?'); //Klammern überflüssig wenn nur OR oder nur AND, alles außerhalb der Klammer muss mitgenommen werden
$statement->bindParam(1,$userid);
$statement->bindParam(2,$userid);
$statement->bindParam(3,$filename);

$statement->execute();

if($statement->rowCount()!=0){ //wenn rowCount nicht = 0 ist...

    $filepath=$directory.$filename; //... $filepath die werte von $directory und $filename angehängt
    header("Content-Type:".$mimetypes);
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header("Content-Transfer-Encoding: binary ");
    header("Content-Length: ".filesize($filepath));
    readfile($filepath); //readfile gibt endgültigen Dateipfad aus
}
}
