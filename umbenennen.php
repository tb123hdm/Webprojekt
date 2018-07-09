<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}
$aktuellerordner=$_GET['aktuellerordner'];
$ordnerid=$_GET['ordnerid'];
$neuername=$_POST['neuername'];

$statement=$db->prepare('UPDATE Ordner SET ordnername=? WHERE ID=? and OwnerID=?');
$statement->bindParam(1, $neuername);
$statement->bindParam(2,$ordnerid);
$statement->bindParam(3,$userid);
$statement->execute();
if (isset($_GET['aktuellerordner'])) {
    header('Location: hauptseite.php?ordnerid=' . $_GET['aktuellerordner']);
} else {
    header('Location: hauptseite.php');
        }