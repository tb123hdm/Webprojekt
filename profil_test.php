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

        <title>Mein Konto</title>

        <link rel="stylesheet" type="text/css" href="profil_test.css">
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
                <ul class="navbar-nav mr-auto">
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
                                echo '<img src="standardbild.jpg"  width="50" height="50" class="rounded-circle" alt="" >';
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

                <div class="dropdown" style="width: 50px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + NEU
                    </button>
                    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="upload-modal">Füge neue Dateien hinzu!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload-file"></label>

                                        <form action="upload.php<?php
                                        if(isset($_GET['ordnerid'])){
                                            echo '?ordnerid='.$_GET['ordnerid'];
                                        }
                                        ?>" method="post" enctype="multipart/form-data">
                                            <input type="file" name="uploaddatei" size="5000000" class="form-control-file" id="upload-file">
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <input type="submit" value="Hochladen" name="upload" class="btn btn-primary"> </input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="folder-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Neuer Ordner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload-file"></label>

                                        <form action="ordner.php<?php
                                        if(isset($_GET['ordnerid'])){
                                            echo '?ordnerid='.$_GET['ordnerid'];
                                        }
                                        ?>" method="post">
                                            <input type="text" name="ordnername" class="form-control">
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <input type="submit" value="Erstellen" name="submit" class="btn btn-primary"> </input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" data-toggle="modal" data-target="#folder-modal"><i class="fas fa-folder" style="margin-right: 10px"></i>Ordner erstellen</button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" data-target="#upload-modal"><i class="fas fa-file-upload" style="margin-right: 10px"></i>Datei hochladen</button>
                    </div>
                </div>

                <div>
                    <form action="suche.php" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" name="suchwort" type="search" placeholder="Suche..." aria-label="Search" style="font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 1px;">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; border-color: lightgrey; color: lightgrey; background-color: inherit;">Los</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>


    <div class="card text-center" style="margin: 20px; height: auto">
        <div class="card-body">
            <div class="container">
                <h2 class="card-title">Mein Konto</h2><br>
                <div class="row">
                    <div class="col">
                        <div class="bild">
                            <?php
                            if ($bild == NULL) {
                                echo "<img src='standardbild.jpg'  id='bild'>";
                            } else {
                                echo '<img src="';
                                echo $upload_bild;
                                echo '" class="rounded-circle" width="200px" height="200px" >';
                            }

                            ?>
                        </div>
                    </div>

                    <div class="col">
                        <br>
                        <h5>Mailadresse:</h5>
                        <?php
                        $statement = $db->prepare('SELECT Email FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while ($row = $statement->fetch()) {
                            echo $row["Email"];
                        }
                        ?><br><br>
                        <h5>Vorname:</h5>
                        <?php
                        $statement = $db->prepare('SELECT Vorname FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while ($row = $statement->fetch()) {
                            echo $row["Vorname"];
                        }
                        ?><br><br>
                        <h5>Nachname:</h5>
                        <?php
                        $statement = $db->prepare('SELECT Nachname FROM Nutzer WHERE ID=?');
                        $statement->bindParam(1, $userid);
                        $statement->execute();
                        while ($row = $statement->fetch()) {
                            echo $row["Nachname"];
                        }
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
    </div>


    </body>
    </html>
    <?php
}
?>