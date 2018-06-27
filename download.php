<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}

//https://mars.iuk.hdm-stuttgart.de/~gurzki/dl/download2.php?filename=bild.jpg
$directory = "/home/tb123/public_html/cleo/uploads/";

$mimetypes = array (
    '.doc'=> 'application/msword',
    '.jpeg'=> 'image/jpeg',
    '.jpg'=> 'image/jpg',
    '.png'=> 'image/png',
    '.pdf'=> 'application/pdf',
    '.ppt'=> 'application/mspowerpoint',
);
if(empty($_GET["dateiname"])) //ob Dateiname übergeben wurde
{
    echo " keine Datei zum Download ausgewählt.";
    die();
}
else
{
    $filename=$_GET["dateiname"];
}
$filepath=$directory.$filename;
header("Content-Type:".$mimetype);
header('Content-Disposition: attachment;filename="'.$filename.'"');
header("Content-Transfer-Encoding: binary ");
header("Content-Length: ".filesize($filepath));
readfile($filepath);
