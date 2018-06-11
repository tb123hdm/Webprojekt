<?php
session_start();
require_once('config.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="profil_style.css" type="text/css" rel="stylesheet">
    <head/>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <img src="logo.png" width="120" height="80" alt="">
                </a>
            </nav>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Einstellungen
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profil.php">Mein Konto</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Abmelden</a>
                        </div>
                    </li>
                    <nav style='padding-left:50px' class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="profil.php">
                            <?php
                            $userid = $_SESSION['user'];
                            $upload_folder='/cleo/uploads/';
                                $statement = $db->prepare('SELECT Bild FROM Nutzer WHERE ID=?'); //Über Session hier noch ID automatisch eintragen lassen
                                $statement->bindParam(1, $userid);
                                $statement->execute();
                                while ($row = $statement->fetch()) {
                                    if ($row['Bild']==NULL) {
                                        echo "<img src='standardbild.jpg' width=\"60\" height=\"60\" class=\"rounded-circle\" >";
                                    }
                                    else {
                                        echo '<img src="$upload_folder$row" class="rounded-circle" width="60" height="60"/>';
                                    }
                                }

                                $statement = $db->prepare('SELECT vorname FROM Nutzer WHERE ID=?');
                                $statement->bindParam(1, $userid);
                                $statement->execute();
                                while ($row = $statement->fetch()) {
                                    echo $row["Vorname"];
                                }

                            ?>
                        </a>
                    </nav>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
    <head>
        <title>Kontoverwaltung</title>
    </head>
<body>


<div class="inhalt">


    <div class="container">
        <h1>Mein Konto</h1><br>
        <div class="row">
            <div class="col">
                <div class="bild">
                    <?php
                        if ($bild==NULL) {
                            echo "<img src='standardbild.jpg' class=\"rounded-circle\" id='bild'>";
                        }
                        else {
                            echo '<img src="$upload_folder$row" class="rounded-circle" id="bild"/>';
                        }

                    ?>
                </div>
            </div>

            <div class="col">
                <br>
                Mailadresse:
                <?php
                        $statement=$db->prepare('SELECT Email FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while($row=$statement->fetch()) {
                        echo $row["Email"];}
                ?><br><br>
                Vorname:
                <?php
                        $statement=$db->prepare('SELECT Vorname FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while($row=$statement->fetch()) {
                        echo $row["Vorname"];}
                ?><br><br>
                Nachname:
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
</body>
</html>