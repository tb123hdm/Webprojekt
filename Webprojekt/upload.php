<?php
if(isset($_POST['upload'])) {
    $upload_ordner = 'uploads/'; //Ordner für hochgeladene Dateien
    $file = pathinfo($_FILES['uploaddatei']['name'], PATHINFO_FILENAME); //Pathinfo liefert Infos über den Dateipfad
    $extension = strtolower(pathinfo($_FILES['uploaddatei']['name'], PATHINFO_EXTENSION));

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
    $new_path = $upload_ordner . $file . '.' . $extension;

//Neuer Dateiname falls Datei mit dem gleichen Namen bereits existiert-> Zufällige ID gernerieren
    if (file_exists($new_path)) { //Falls Datei mit name bereits existiert, wird Zahl angehängt
        $id = 1;
        do {
            $new_path = $upload_ordner . $file . '.' . $extension;
            $id++;
        } while (file_exists($new_path));
    }

//Falls Datei allen Anforderungen entspricht und erfolgreich hochgeladen wird:

    move_uploaded_file($_FILES['uploaddatei']['tmp_name'], $new_path);
    echo 'Bild erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a>';

}

?>

//berechtigungen, sql datenbank eintrag, name, eigentümer, session_id nutzer, insert into


