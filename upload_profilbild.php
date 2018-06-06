<?php
session_start();
if (isset($_POST['hochladen'])) {
    $upload_folder = 'uploads/';
   // $filename = pathinfo($_FILES['bild']['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($_FILES['bild']['name'], PATHINFO_EXTENSION));


//Überprüfung der Dateiendung
    $allowed_extensions = array('png', 'jpg', 'jpeg');
    if (!in_array($extension, $allowed_extensions)) {
        die("Ungültige Dateiendung. Nur png, jpg und jpeg-Dateien sind erlaubt");
    }

//Überprüfung der Dateigröße
    $max_size = 4000000;
    if ($_FILES['bild']['size'] > $max_size) {
        die("Bitte keine Dateien größer 500kb hochladen");
    }

//Überprüfung dass das Bild keine Fehler enthält
    if (function_exists('exif_imagetype')) { //exif_imagetype erfordert die exif-Erweiterung
        $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
        $detected_type = exif_imagetype($_FILES['bild']['tmp_name']);
        if (!in_array($detected_type, $allowed_types)) {
            die("Nur der Upload von Bilddateien ist gestattet");
        }
    }


//Pfad zum Upload
    $new_path = $upload_folder . $_SESSION['user'] . '.' . $extension;

//Neuer Dateiname falls die Datei bereits existiert

/*
    if (file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
        $id = 1; // ID des Nutzers anfügen --> SESSION generieren und ID des Nutzers anhängen
        do {
            $new_path = $upload_folder . $filename . '_' . $id . '.' . $extension;
            $id++;
        } while (file_exists($new_path));
    }
*/
//Alles okay, verschiebe Datei an neuen Pfad
    move_uploaded_file($_FILES['bild']['tmp_name'], $new_path);
  /*  while (move_uploaded_file($_FILES['bild']['tmp_name'], $new_path)) {
        $pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-tb123', 'name', 'pw');
        $statement = $pdo->prepare('UPDATE Nutzer SET bild=? WHERE ID=?');
        $statement->execute(array($new_path, $_SESSION['user']));
jsj
    }
*/
    echo 'Bild erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a>';





}

?>