<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}

if (isset($_GET['dateiid'])) {
    $dateiid = $_GET['dateiid'];
    $freigabe = $_POST['freigabe'];
    if ($freigabe != '1') {
        $freigabe = '0';
    }

    $statement = $db->prepare('SELECT * FROM Datei WHERE OwnerID=? AND ID=?');
    $statement->bindParam(1, $userid);
    $statement->bindParam(2, $dateiid);
    $statement->execute();
    if ($statement->rowCount() != 0) {
        $ergebnis=$statement->fetch();

        $statement = $db->prepare('UPDATE Datei SET Freigabe=? WHERE ID=?');   //Freigabe Button für Teilen mit Fremden
        $statement->bindParam(1, $freigabe);
        $statement->bindParam(2, $dateiid);
        $statement->execute();

        if (strlen($_POST['fremder']) > 4) {   //Teilen mit Fremden
            $email = $_POST['fremder'];
            $dateiname = $ergebnis['dateiname'];
            mail($email, 'Link für deine Datei', 'Lade dir die freigegebene Datei herunter <br><br> <a href="https://mars.iuk.hdm-stuttgart.de/~tb123/cleo/download.php?dateiname=' . $dateiname . '">Hier kommst du zu deiner Datei</a><br><br> Liebe Grüße CLEO', [
                'MIME-Version: 1.0','Content-type: text/html; charset=iso-8859-1']);


            //Teilen mit CLEO-Nutzern -->
        }

        if (strlen($_POST['email']) > 4) {
            $email = $_POST['email'];

            $statement = $db->prepare('SELECT ID FROM Nutzer WHERE email=?');
            $statement->bindParam(1, $email);
            $statement->execute();
            if ($statement->rowCount() != 0) {
                $nutzerid = $statement->fetch()['ID'];

                $statement = $db->prepare('SELECT * FROM Freigabe WHERE UserID=? AND DateiID=?'); //überprüfen ob Freigabe bereits vorhanden
                $statement->bindParam(1, $nutzerid);
                $statement->bindParam(2, $dateiid);
                $statement->execute();
                if ($statement->rowCount() == 0) {

                    $statement = $db->prepare('INSERT INTO Freigabe (DateiID, UserID) VALUES (?,?)');
                    $statement->bindParam(1, $dateiid);
                    $statement->bindParam(2, $nutzerid);
                    $statement->execute();
                }
            }
        }
    }
}
if(isset($_GET['ordnerid'])){
    header('Location: hauptseite.php?ordnerid='.$_GET['ordnerid']);
}
else
    header('Location: hauptseite.php');