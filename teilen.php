<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}

if (isset($_GET['dateiid'])) {
    $dateiid = $_GET['dateiid'];
    $freigabe = $_POST['freigabe']; //wenn Checkbox angeklick wurde -> Haken gesetzt
    if ($freigabe != '1') { //Wert 1 wird gesetzt, wenns freigegeben ist
        $freigabe = '0';
    }

    $statement = $db->prepare('SELECT * FROM Datei WHERE OwnerID=? AND ID=?');
    $statement->bindParam(1, $userid);
    $statement->bindParam(2, $dateiid);
    $statement->execute();
    if ($statement->rowCount() != 0) { //zählen, wie viele Dateien zurückgekommen sind, darf nur 1 oder 0 sein,
        $ergebnis=$statement->fetch(); //Ergebnisse werden in $ergebnis geschrieben

        $statement = $db->prepare('UPDATE Datei SET Freigabe=? WHERE ID=?');   //Freigabe Button für Teilen mit Fremden, Freigabe wollen wir auf 0 oder 1 setzen, Upate Tabelle
        $statement->bindParam(1, $freigabe);
        $statement->bindParam(2, $dateiid);
        $statement->execute();

        //Teilen mit fremden

        if (strlen($_POST['fremder']) > 4) {   //Teilen mit Fremden, wenn etwas eingegeben wurde, das > 4 ist, dann: wird Post in variable gespeichert , strlen checkt länge des Strings
            $empfaenger = $_POST['fremder'];
            $dateiname = $ergebnis['dateiname'];
            $betreff = "Jemand will etwas mit dir über Cleo teilen";
            $message = '
                <html>
                <head>
                  <title>Cleo</title>
                </head>
                <body>

                    <h1>Hier geht es zu deiner Datei auf Cleo</h1> </br>
                    <a href="https://mars.iuk.hdm-stuttgart.de/~tb123/cleo/download.php?dateiname=' . $dateiname . '">Ich bin dein Download!</a>
                    <hr>
                    <p> Mit besten Grüßen aus Stuttgart</p> </br>
                    <p> Dein Cleo Team.</p>


                </body>
                </html>
';
            $header = "From: Cleo Download <tb123@hdm-stuttgart.de>" . "\r\n" .
                 "Reply-To: No-Reply <tb123@hdm-stuttgart.de'>" . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset=utf-8'. "\r\n".
                'X-Mailer: PHP/' . phpversion();

            mail ($empfaenger, $betreff, $message, $header);
                 //übergebene Email adresse wird eingetragen
            //asdasd


            //Teilen mit CLEO-Nutzern
        }

        if (strlen($_POST['email']) > 4) { //Sicherheitsmaßnahme, wegen Aufteilung, niemals = 4, immer > 4
            $email = $_POST['email']; //Email wird eingetragen und über Post übergeben

            $statement = $db->prepare('SELECT ID FROM Nutzer WHERE email=?'); // Id von Person die gleiche EmailAdresse hat, wie die die eingegben wurde, wird abgefragt
            $statement->bindParam(1, $email);
            $statement->execute();
            if ($statement->rowCount() != 0) { //wenn kein Nutzer gefunden wurde -> ELSE , wenn 1 rauskommt, wurde nutzer gefunden und
                $nutzerid = $statement->fetch()['ID']; //NutzerID wird von ergebnis geholt und in $Nutzerid gespeichert, ID von Person, mit der geteilt wird

                $statement = $db->prepare('SELECT * FROM Freigabe WHERE UserID=? AND DateiID=?'); //überprüfen ob Freigabe bereits vorhanden für Person, wo UserId=NutzerId die gefetched wurde und dateiId=ID
                $statement->bindParam(1, $nutzerid);
                $statement->bindParam(2, $dateiid);
                $statement->execute();
                if ($statement->rowCount() == 0) { //wenn kein ergebnis rauskommt, wurde Datei für diese Person noch nicht freigegeben, ist das der Fall dann...

                    $statement = $db->prepare('INSERT INTO Freigabe (DateiID, UserID) VALUES (?,?)'); //...In Freigabe wird neuer Datenbankeintrag gemacht
                    $statement->bindParam(1, $dateiid);
                    $statement->bindParam(2, $nutzerid);
                    $statement->execute();
                }
            }
            else {
                header('Location: hauptseite.php?Fehler=Nutzer konnte nicht gefunden werden.'); // wenn Emailadresse Falsch oder Nutzer nicht vorhanden -> weiterleitung auf
            }
        }
    }
}
if(isset($_GET['ordnerid'])){
    header('Location: hauptseite.php?ordnerid='.$_GET['ordnerid']); //wenn in Ordner
}
else
    header('Location: hauptseite.php'); //wenn in Root