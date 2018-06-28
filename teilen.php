<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}
var_dump($_POST['freigabe'], $_GET['dateiid']);
if (isset($_GET['dateiid'])){
    $dateiid=$_GET['dateiid'];
    $freigabe=$_POST['freigabe'];
    if($freigabe!='1'){
        $freigabe='0';
    }

    $statement=$db->prepare('UPDATE Datei SET Freigabe=? WHERE ID=?');
    $statement->bindParam(1,$freigabe);
    $statement->bindParam(2,$dateiid);
    $statement->execute();

    if(isset($_GET['ordnerid'])){
        header('Location: hauptseite.php?ordnerid='.$_GET['ordnerid']);
    }
    else{
        header('Location: hauptseite.php');
    }

}