<?php
session_start();
require_once ('config.inc.php');
$email= $_POST[email];
$userid = $_SESSION['user'];

$statement=$db->prepare('SELECT ID FROM Nutzer WHERE email=?'); // user id eingefügt mit der ich eingeloggt bin
$statement->bindParam(1, $email);
$statement->execute();
$berechtigung_id=$statement->fetch();


$statement=$db->prepare('INSERT INTO Freigabe (DateiID, OwnerID, UserID) VALUES (?,?,?)'); // user id eingefügt mit der ich eingeloggt bin
$statement->bindParam(1,);
$statement->bindParam(2,$userid);
$statement->bindParam(3,$berechtigung_id);
$statement->execute();



?>
