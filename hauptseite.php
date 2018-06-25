<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if($userid==0){
    header('Location: cover.html');
}
else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="hauptseite.css">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>



</head>
<body>
<header>

    <!----Navbar--->

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="hauptseite.html" style="font-family:'Megrim', cursive;  font-size: x-large; color: white; ">C L E O
        </a>
        <button class="navbar-toggler"  style="border-color: darkgrey;" type="button" data-toggle="collapse"  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="hauptseite.html" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; color: lightgrey; margin-left: 20px;">Dashboard <span class="sr-only">(current)</span></a>
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


            <!---Datei-Upload--->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#upload-modal"> + NEU</button>
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

                                    <form action="upload.php" method="post" enctype="multipart/form-data">
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

            <!---Benutzer-Profilbild--->
            <img src="Bilder/userbild.jpg"  width="40" height="40" class="d-inline-block align-top img_profile" alt="" style="margin-right: auto;">




            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Suche..." aria-label="Search" style="font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 1px;">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; border-color: lightgrey; color: lightgrey; background-color: inherit;">Los</button>
            </form>
        </div>
    </nav>
</header>

<h1 style="padding-left: 80px; margin-top: 40px; margin-bottom: 20px;">Meine Ablage</h1>


<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"> </th>
        <th scope="col">Name</th>
        <th scope="col">Eigentümer</th>
        <th scope="col">Funktionen</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th scope="row"> </th>
        <td><i class="far fa-folder-open" style="margin-right:20px; "></i>
            <?php //Abfrage Root Ordner

            $statement=$db->prepare('SELECT * FROM Ordner WHERE OwnerID=? and ParentID IS NULL'); // user id eingefügt mit der ich eingeloggt bin
            $statement->bindParam(1, $userid);
            $statement->execute();
            $root=$statement->fetch();


            $statement=$db->prepare('SELECT * FROM Ordner WHERE ParentID= '.$root ['ID']); // query für Unterodner
            $statement->execute();
            $unterordner=$statement->fetch();
            echo $unterordner ['ordnername'];

            ?>

        </td>

        <!--Benutzername-->
        <td>er042</td>

        <td><button type="button" class="far fa-trash-alt" data-toggle="modal" data-target="#delete-modal"></button>
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-modal">Bist Du dir sicher?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Wenn Du auf "Löschen" klickst, wird die von Dir ausgewählte Datei unwiederruflich gelöscht.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                            <button action="delete.php" method="post" name="delete" type="button" class="btn btn-primary">Löschen</button>
                        </div>
                    </div>
                </div>
            </div>

            <!---Funktion: Download--->
            <i class="fas fa-arrow-down" style="padding-right: 10px; padding-left:10px;">
                <form action="download.php" method="get">

                </form>
            </i>


            <button type="button" class="fas fa-user-shield" data-toggle="modal" data-target="#licence-modal"> <! Pop-Up für die Funktion: Benutzerverwaltung>
            </button>
            <div class="modal fade" id="licence-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Benutzerverwaltung</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Freunde, mit denen Du deine Ideen bereits teilst:</p>
                            <?php //Abfrage wer hat Zugriff

                            $statement=$db->prepare('SELECT Nutzer.email FROM Nutzer, Freigabe WHERE Nutzer.id=Freigabe.UserID'); // user id eingefügt mit der ich eingeloggt bin
                            $statement->execute();
                            $berechtigung=$statement->fetch();
                            print_r ($berechtigung[0]);
                            ?>
                            <br>
                            <br>
                            <p>Personen hinzufügen:</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <form method="post" action="berechtigung.php">
                                <input type="text" name="email" class="form-control" placeholder="E-Mail-Adresse" aria-label="e-mail" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                            <button type="submit"  class="btn btn-primary">Bestätigen</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="fas fa-share-alt" data-toggle="modal" data-target="#share-modal"></button> <! Pop-Up für die Funktion: Teilen>
            <div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="share-modal">Teile Deine Ideen...</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>... mit Deinen Freunden!</p>
                            <input  type="text" class="form-control" placeholder="Benutzername" aria-label="benutzername" aria-describedby="basic-addon1">
                            <br>
                            <p>oder</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="text" class="form-control" placeholder="E-Mail-Adresse" aria-label="e-mail" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-primary">Teilen</button>
                    </div>
                </div>
            </div>
            </div>
    </tr>
    <tr>
        <th scope="row"> </th>
        <td><i class="far fa-file" style="margin-right:25px; "></i>Mobile Medien</td>

        <td>er042</td> <!Benutzername>

        <td><button type="button" class="far fa-trash-alt" data-toggle="modal" data-target="#delete-modal"></button>
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-modal">Bist Du dir sicher?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Wenn Du auf "Löschen" klickst, wird die von Dir ausgewählte Datei unwiederruflich gelöscht.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                            <button action="delete.php" method="post" name="delete" type="button" class="btn btn-primary">Löschen</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Funktion: Download--->
            <i class="fas fa-arrow-down" style="padding-right: 10px; padding-left:10px;"></i>


            <button type="button" class="fas fa-user-shield" data-toggle="modal" data-target="#licence-modal"> <! Pop-Up für die Funktion: Benutzerverwaltung>
            </button>
            <div class="modal fade" id="licence-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Benutzerverwaltung</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Freunde, mit denen Du deine Ideen bereits teilst:</p>

                            <br>
                            <p>Personen hinzufügen:</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="text" class="form-control" placeholder="E-Mail-Adresse" aria-label="e-mail" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                            <button type="button" class="btn btn-primary">Bestätigen</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="fas fa-share-alt" data-toggle="modal" data-target="#share-modal"></button> <! Pop-Up für die Funktion: Teilen>
            <div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="share-modal">Teile Deine Ideen...</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>... mit Deinen Freunden!</p>
                            <input  type="text" class="form-control" placeholder="Benutzername" aria-label="benutzername" aria-describedby="basic-addon1">
                            <br>
                            <p>oder</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="text" class="form-control" placeholder="E-Mail-Adresse" aria-label="e-mail" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-primary">Teilen</button>
                    </div>
                </div>
            </div>
            </div>
    </tr>
    </tbody>
</table>
</tbody>
</table>



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
    <?php
}
?>