<?php

if($_GET['action'] == "upload") {

// Auf Fehler überprüfen
    if ($_FILES['datei']['error'] == UPLOAD_ERR_NO_FILE || $_FILES['datei']['error'] == UPLOAD_ERR_PARTIAL) {
// die Datei wurde nicht oder nur teilweise hochgeladen
        die("Die Datei konnte nicht hochgeladen werden. Bitte versuche es erneut.");

    } elseif ($_FILES['datei']['error'] == UPLOAD_ERR_FORM_SIZE || $_FILES['datei']['error'] == UPLOAD_ERR_INI_SIZE) {
// die Datei ist zu groß
        die("Die hochgeladene Datei ist zu groß.");

    } else {
// die Datei wurde korrekt hochgeladen

// hier sind die mySQL Daten einzufüllen
        @mysql_connect("mars.iuk.hdm-stuttgart.de", "tb123", "#");
        @mysql_select_db("Datei");

// Temporäre Datei schreiben (ist wegen der Lese-Rechte nötig)
// und auf die temp-Datei Lese Rechte vergeben
        move_uploaded_file($_FILES['datei']['tmp_name'], "./tempfile.tmp");
        chmod("./tempfile.tmp", 0644);

// Daten aus Temp-Datei einlesen
        $zeiger = fopen("./tempfile.tmp", "rb");
        $size = $_FILES['datei']['size'];
// den Dateiinhalt in $data speichern
        $data = fread($zeiger, $size);
        fclose($zeiger);

// Temporäre Datei löschen
        @unlink("./tempfile.tmp");

// Damit die Datei jetzt in die mySQL Tabelle kann müssen wir sie vorher kodieren:
        $data = base64_encode($data);

// Leerzeichen im Dateinamen werden mit einem Unterstrich ersetzt
        $dateiname = str_replace(" ", "_", $_FILES['datei']['name']);

// Und ab in die mySQL Tabelle...
        $sql = "INSERT INTO Datei VALUES('ID', 'Name', 'dateiname','OrdnerID', '".$dateiname."', '".$_FILES['datei']['type']."', '".$data."', '".$size."')";
        @mysql_query($sql);

        echo "Datei-Upload erfolgreich.";
        exit;
    }

} else {
// Upload-Formular anzeigen
    echo "<form method=\"post\" action=\"" . $PHP_SELF . "?action=upload\" enctype=\"multipart/form-data\"> 
<input type=\"hidden\" name=\"MAX_FILES_SIZE\" value=\"2097152\"> 
<input type=\"file\" name=\"datei\" maxlength=\"2097152\"><br> 
<input type=\"submit\" name=\"submit\" value=\"Uploaden\"> 
</form>";
}

?>