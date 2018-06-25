<?php
session_start();
require_once('config.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="profil_style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <head/>
    <body>
    <header>
        <!----Navbar--->

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand" href="hauptseite.php" style="font-family:'Megrim', cursive;  font-size: x-large; color: white; ">C L E O
            </a>
            <button class="navbar-toggler"  style="border-color: darkgrey;" type="button" data-toggle="collapse"  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="hauptseite.php" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; color: lightgrey; margin-left: 20px;">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; color: lightgrey; margin-left: 20px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Einstellungen
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profil.php">Mein Konto</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Abmleden</a>
                        </div>
                    </li>
                </ul>

                <?php
                $userid = $_SESSION['user'];
                $upload_folder='https://mars.iuk.hdm-stuttgart.de/~tb123/cleo/uploads/';
                $statement = $db->prepare('SELECT Bild FROM Nutzer WHERE ID=?');
                $statement->bindParam(1, $userid);
                $statement->execute();
                $row = $statement->fetch();
                $bild = $row['Bild'];
                $upload_bild=$upload_folder.$bild;
                if ($row['Bild']==NULL) {
                    echo '<img src="standardbild.jpg"  width="50" height="50" class="rounded-circle" alt="" style="margin-right: 250px;">';
                }
                else {
                    echo '<img src="';
                    echo $upload_bild;
                    echo '" width="60" height="100%" class="rounded-circle" alt="" style="margin-right: 250px">';
                }
                ?>


    </header>
    <head>
        <title>Kontoverwaltung</title>
    </head>


<div class="inhalt">


    <div class="container">
        <h1>Mein Konto</h1><br>
        <div class="row">
            <div class="col">
                <div class="bild">
                    <?php
                        if ($bild==NULL) {
                            echo "<img src='standardbild.jpg' class=\"rounded-circle\" width=\"300px\" height=\"300px\" id='bild'>";
                        }
                        else {
                            echo '<img src="';
                            echo $upload_bild;
                            echo '" class="rounded-circle" width="100%" height="100%" >';
                        }

                    ?>
                </div>
            </div>

            <div class="col">
                <br>
                <h5>Mailadresse:</h5>
                <?php
                        $statement=$db->prepare('SELECT Email FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while($row=$statement->fetch()) {
                        echo $row["Email"];}
                ?><br><br>
                <h5>Vorname:</h5>
                <?php
                        $statement=$db->prepare('SELECT Vorname FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while($row=$statement->fetch()) {
                        echo $row["Vorname"];}
                ?><br><br>
                <h5>Nachname:</h5>
                <?php
                        $statement=$db->prepare('SELECT Nachname FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while($row=$statement->fetch()) {
                        echo $row["Nachname"];}
                ?>
                <br><br>
            </div>
        </div>
    <br><br>
    </div>
    <div class="aendern">
        <form action="upload_profilbild.php" method="post" enctype="multipart/form-data">
            <input type="file" name="bild">
            <input type="submit" value="Hochladen" name="hochladen">
        </form>
    </div>
    </div>
</div>



    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <!-- Footer -->
    <section id="footer">
        <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h3>C L E O</h3>
                    <br>
                    <p>Hochschule der Medien<br>
                        Nobelstraße 10<br>
                        70569 Stuttgart</p>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Allgemeines</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="über_uns.html"><i class="fa fa-angle-double-right"></i>Über uns</a></li>
                        <li><a href="datenschutz.html"><i class="fa fa-angle-double-right"></i>Datenschutz</a></li>
                    </ul>
                </div>
                <br>
            </div>
            <br>
            <div class="row" style="font-family: 'Open Sans Condensed', sans-serif;">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p class="h6">&copy Alle Rechte vorbehalten.<a class="text-green ml-2" href="https://www.hdm-stuttgart.de/" target="_blank">Hochschule der Medien Stuttgart</a></p>
                </div>
                </hr>
            </div>
        </div>
    </section>
    <!-- ./Footer -->

</body>
</html>