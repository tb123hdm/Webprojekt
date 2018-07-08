<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}
$ordnerid=$_GET['ordnerid'];
$neuername=$_POST['neuername'];

$statement=$db->prepare('UPDATE Ordner SET ordnername=? WHERE ID=? and OwnerID=?');
$statement->bindParam(1, $neuername);
$statement->bindParam(2,$ordnerid);
$statement->bindParam(3,$userid);
$statement->execute();
header('Location:hauptseite.php');