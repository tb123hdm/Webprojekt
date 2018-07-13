<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}
else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Cleo - Mein Konto</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="profil.css">
        <link rel="stylesheet" type="text/css" href="hauptseite.css">
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
              integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
              crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script>

</script>

    </head>
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
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <!--<a class="nav-link" href="hauptseite.php" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; color: lightgrey; margin-left: 20px;">Dashboard <span class="sr-only">(current)</span></a>-->
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; color: lightgrey; margin-left: 20px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $userid = $_SESSION['user'];
                            $upload_folder='https://mars.iuk.hdm-stuttgart.de/~tb123/cleo/uploads/';
                            $statement = $db->prepare('SELECT * FROM Nutzer WHERE ID=?');
                            $statement->bindParam(1, $userid);
                            $statement->execute();
                            $row = $statement->fetch();
                            $bild = $row['bild'];
                            $upload_bild=$upload_folder.$bild;
                            if ($row['bild']==NULL) {
                                echo '<img src="Media/standardbild.jpg"  width="50" height="50" class="rounded-circle mr-3" alt="" >';
                            }
                            else {
                                echo '<img src="';
                                echo $upload_bild;
                                echo '" width="50" height="50" style="object-fit:cover" class="rounded-circle mr-3" alt="">';
                            }
                            echo $row['vorname'];
                            ?>

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profil.php">Mein Konto</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="abmelden.php">Abmelden</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!---Body--->
    <div class="card" style="margin: 30px;">
        <div class="card-header">
            <h4 style="font-family: 'Poppins', sans-serif; margin: 5px">Mein Konto</h4>
        </div>
        <div class="card-body">
                <div class="container">
                    <br>
                    <div class="row">
                        <div class="col">
                            <div id="bild" >
                                <?php
                                if ($bild == NULL) {
                                    echo "<img src='Media/standardbild.jpg' class=\"rounded-circle\" width=\"250px\" height=\"250px\">";
                                } else {
                                    echo '<img src="';
                                    echo $upload_bild;
                                    echo '" class="rounded-circle" style="object-fit:cover" width="250px" height="250px" >';
                                }

                                ?>
                            </div>
                        </div>

                        <div class="col">
                            <br>
                            <h5>Name:</h5>
                            <?php
                            $statement = $db->prepare('SELECT Vorname FROM Nutzer WHERE ID=?');
                            $statement->bindParam(1, $userid);
                            $statement->execute();
                            while ($row = $statement->fetch()) {
                                echo $row["Vorname"];
                            }
                            ?>
                            <?php
                            $statement = $db->prepare('SELECT Nachname FROM Nutzer WHERE ID=?');
                            $statement->bindParam(1, $userid);
                            $statement->execute();
                            while ($row = $statement->fetch()) {
                                echo $row["Nachname"];
                            }
                            ?>
                            <br><br>
                            <h5>E-Mail Adresse:</h5>
                            <?php
                            $statement = $db->prepare('SELECT Email FROM Nutzer WHERE ID=?');
                            $statement->bindParam(1, $userid);
                            $statement->execute();
                            while ($row = $statement->fetch()) {
                                echo $row["Email"];
                            }
                            ?><br><br>

                        </div>
                    </div>
                    <br><br>
                </div>
            <div class="aendern">
                <form action="upload_profilbild.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="bild">
                    <input type="submit" value="Hochladen" name="hochladen" style="background-color: inherit; border-radius: 15px;">
                </form>
            </div>
        </div>
    </div>

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
                        <li><a href="about_us.php"><i class="fa fa-angle-double-right"></i>Über uns</a></li>
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
            </div>
        </div>
    </section>
    <!-- ./Footer -->


    </body>
    </html>
    <?php
}
?>