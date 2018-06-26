<?php
session_start();
require_once ('config.inc.php');
$userid = $_SESSION['user'];

if(isset($_POST['upload'])) {
    $fullpath ='/home/tb123/public_html';
    $upload_ordner = '/cleo/uploads/'; //Ordner für hochgeladene Dateien
    $file = pathinfo($_FILES['uploaddatei']['name'], PATHINFO_FILENAME); //Pathinfo liefert Infos über den Dateipfad
    $extension = strtolower(pathinfo($_FILES['uploaddatei']['name'], PATHINFO_EXTENSION));
    print_r ($_FILES );
//Sicherer Dateiupload

//Überprüfung ob Datei mit zugelassener Dateiendung hochgeladen wurde
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'ppt', 'zip');

    if (!in_array($extension, $allowed_extensions)) { //wenn eine Datei mit einem Dateiformat hochgeladen wird, dass hier nicht aufgelistet wird, erscheint folgendes:
        die ('Ungültiges Dateiformat.');
    }

//Überprüfung auf zugelassene Dateigröße

    $max_size = 5000000;

    if ($_FILES['uploaddatei']['size'] > $max_size) {
        die ('Die Dateigröße darf 5MB nicht überschreiten.');
    }

    echo $file;


//Pfad zum Upload
    $bildname =  uniqid($_SESSION['user']) . '.' . $extension;
    $new_path = $fullpath.$upload_ordner.$bildname;


    /*
//Pfad zum Upload
   // $new_path = $upload_ordner . $file . '.' . $extension;
    $new_path = $fullpath.$upload_ordner.$file . '.' . $extension;

//Neuer Dateiname falls Datei mit dem gleichen Namen bereits existiert-> Zufällige ID gernerieren
    if (file_exists($new_path)) { //Falls Datei mit name bereits existiert, wird Zahl angehängt
        $id = 1;
        do {
            $dateiname =  $file . '-'.$id.'.' . $extension;
            $new_path = $fullpath.$upload_ordner .$dateiname;
            $id++;
        } while (file_exists($new_path));
    }
    */

//Falls Datei allen Anforderungen entspricht und erfolgreich hochgeladen wird:
    move_uploaded_file($_FILES['uploaddatei']['tmp_name'], $new_path);
    $statement = $db->prepare('INSERT INTO Datei (original_name, dateiname, OrdnerID) VALUES (?,?, (SELECT Ordner.ID FROM Ordner WHERE OwnerID=?))');
   // 'ALTER TABLE Freigabe ADD FOREIGN KEY (DateiID) REFERENCES Datei (ID), ADD FOREIGN KEY (OwnerID) REFERENCES Nutzer (ID), ADD FOREIGN KEY (UserID) REFERENCES Nutzer (ID)');
    $statement->bindParam(1, $file);
    $statement->bindParam(2, $bildname);
    $statement->bindParam(3, $userid);
    if (!$statement->execute()){
        echo "Datenbank-Fehler:";
        echo $statement->errorInfo()[2];
        echo $statement->queryString;
        die(); }
    echo 'Datei erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a>';
}

//berechtigungen, sql datenbank eintrag, name, eigentümer, session_id nutzer, insert into

/*
move_uploaded_file($_FILES['uploaddatei']['tmp_name'],  '/home/tb123/public_html/cleo/uploads'.$new_path);
$statement = $db->prepare("INSERT INTO Datei VALUES('ID', 'Name', 'dateiname','OrdnerID', '");
$statement->bindParam(1,$file);
$statement->bindParam(2,$_SESSION['user']);
echo "User-ID:".$_SESSION['user'];
if (!$statement->execute()){
echo "Datenbank-Fehler:";
echo $statement->errorInfo()[2];
echo $statement->queryString;
die(); }
echo 'Datei erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a>';
}

//berechtigungen, sql datenbank eintrag, name, eigentümer, session_id nutzer, insert into

*/
?>
