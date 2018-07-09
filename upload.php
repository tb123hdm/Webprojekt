<?php
session_start();
require_once ('config.inc.php');
$userid = $_SESSION['user'];

if(isset($_GET['ordnerid'])){ //wenn man sich im Ordner befindet, wird OrdnerID gesetzt und wird unten eingetragen
    $ordnerid=$_GET['ordnerid'];
}
else{
    $ordnerid= NULL; //wenn man sich in root Ordner
}


if(isset($_POST['upload'])) { //wenn Button gedrückt wurde, passiert folgendes: , verhindert Zugriff auf upload.php über URL, wenn Button nicht gedrück, ist POST nicht gesetzt
    $fullpath ='/home/tb123/public_html';
    $upload_ordner = '/cleo/uploads/'; //Ordner für hochgeladene Dateien
    $file = pathinfo($_FILES['uploaddatei']['name'], PATHINFO_FILENAME); //Pathinfo liefert Infos über den Dateipfad //upploaddatei kommt aus der Form von hauptseite.php, wird dort übergeben
    $extension = strtolower(pathinfo($_FILES['uploaddatei']['name'], PATHINFO_EXTENSION)); //name = originalname, extension wird rausgepickt-> wird hinten ausgewählt

//Sicherer Dateiupload

//Überprüfung ob Datei mit zugelassener Dateiendung hochgeladen wurde
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx' , 'ppt',  'pptx', 'zip', 'pages', 'key', 'mp3', 'mp4', 'mov');

    if (!in_array($extension, $allowed_extensions)) { //wenn eine Datei mit einem Dateiformat hochgeladen wird, dass hier nicht aufgelistet wird, erscheint folgendes:
        header('Location: hauptseite.php?Fehler=Ungültiges Dateiformat.');
        exit;
    }

//Überprüfung auf zugelassene Dateigröße

    $max_size = 32000000; //begründen
    if ($_FILES['uploaddatei']['size'] > $max_size) {
        header('Location: hauptseite.php?Fehler=Die Dateigröße darf 32 MB nicht überschreiten.');
        exit;
    }

//Pfad zum Upload
    $bildname =  uniqid($_SESSION['user']) . '.' . $extension; //UniqueID wird über aktuelle Zeit in Mikrosekunden generiert, ist PHP Funktion, UserID wird vorne drangehängt
    $new_path = $fullpath.$upload_ordner.$bildname;



//Falls Datei allen Anforderungen entspricht und erfolgreich hochgeladen wird:
    move_uploaded_file($_FILES['uploaddatei']['tmp_name'], $new_path); //sobald Methode aufgerufen wird, wird Datei in $newpath verschoben
    $statement = $db->prepare('INSERT INTO Datei (original_name, dateiname, OrdnerID, OwnerID) VALUES (?,?,?,?)');

    $statement->bindParam(1, $file);
    $statement->bindParam(2, $bildname);
    $statement->bindParam(3,$ordnerid);
    $statement->bindParam(4, $userid);
    $statement->execute();

    if (isset($_GET['ordnerid'])) { //kommt OrdnerID in URL vor //wenn OrdnerID gesetzt wurde, wird diese an ordnerid in url dranhängen, wenn nicht gesetzt kommt man nicht in Ordner
        header('Location: hauptseite.php?ordnerid=' . $_GET['ordnerid']); //wenn wir in ordner sind und dahin zurück wollen wird ordnerid angehängt
    } else {
        header('Location: hauptseite.php'); //wenn man sich in keinem Ordner befindet, wird man direkt auf Hauptseite weitergeleitet, es wird keine ID angehängt
    }
}
?>
