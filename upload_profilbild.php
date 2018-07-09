<?php
session_start();
require_once ('config.inc.php');
if (isset($_POST['hochladen'])) {
    $fullpath ='/home/tb123/public_html';
    $upload_folder = '/cleo/uploads/';
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
    $bildname =  uniqid($_SESSION['user']) . '.' . $extension;
    $new_path = $fullpath.$upload_folder.$bildname;


//Alles okay, verschiebe Datei an neuen Pfad
    move_uploaded_file($_FILES['bild']['tmp_name'], $new_path);
        $statement = $db->prepare('UPDATE Nutzer SET bild=? WHERE ID=?');
        $statement->bindParam(1,$bildname);
        $statement->bindParam(2,$_SESSION['user']);
        echo "User-ID:".$_SESSION['user'];
        if (!$statement->execute()){
           echo "Datenbank-Fehler:";
           echo $statement->errorInfo()[2];
           echo $statement->queryString;
           die(); }
    echo "Bild erfolgreich hochgeladen: <a href\"$upload_folder$bildname\">$new_path</a>";
    header('Location: profil.php');


    // echo



}

?>