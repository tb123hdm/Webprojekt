<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
if(!isset($userid)){
    header('Location: cover.html');
}
if(isset($_GET['ordnerid'])){
    $ordnerid=$_GET['ordnerid'];
    $operator= "=";
}
else{
    $ordnerid= NULL;
    $operator= 'IS';
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Dashboard</title>

        <link rel="stylesheet" type="text/css" href="hauptseite_test.css">
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
                                echo '<img src="standardbild.jpg"  width="50" height="50" class="rounded-circle mr-3" alt=""  >';
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




                <!---Datei-Upload--->

                <div class="dropdown ml-auto mr-auto">
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





                <form action="suche.php" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="suchwort" type="search" placeholder="Suche..." aria-label="Search" style="font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 1px;">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style=" font-family: 'Open Sans Condensed', sans-serif; font-weight: normal; letter-spacing: 2px; border-color: lightgrey; color: lightgrey; background-color: inherit;">Los</button>
                </form>
            </div>
        </nav>
    </header>



    <!---Überschrift Dashboard--->
    <h1 style="padding-left: 80px; margin-top: 40px; margin-bottom: 20px;">Meine Ablage</h1>


    <!---Tabelle mit Ordnern und Dateien--->
    <div style="min-height: 100%;">
    <table class="table table-striped tabelle">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Eigentümer</th>
            <th scope="col">Funktionen</th>
        </tr>
        </thead>
        <tbody>

        <?php


        //ORDNER ANZEIGEN
        $statement=$db->prepare('SELECT * FROM Ordner WHERE OwnerID=? and ParentID '.$operator.' ? '); // user id eingefügt mit der ich eingeloggt bin
        $statement->bindParam(1, $userid);
        $statement->bindParam(2,$ordnerid);
        $statement->execute();
        //print_r ($statement->fetchAll());
        foreach($statement->fetchAll() as $root) {

            ?>

            <tr>

                <td><i class="far fa-folder-open" style="margin-right:25px; "></i>
                    <a  class="ordner-link" href="hauptseite.php?ordnerid=<?=$root['ID']?>">
                        <?=$root['ordnername']?></a>
                </td>

                <!--Benutzername-->
                <td>
                    ich
                </td>

                <td>
                    <button type="button" class="far fa-trash-alt" data-toggle="modal" data-target="#delete-folder-modal-<?=$root['ID']?>"></button>
                    <div class="modal fade" id="delete-folder-modal-<?=$root['ID']?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Bist Du dir sicher?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Wenn Du auf "Löschen" klickst, wird die von Dir ausgewählte Datei unwiederruflich
                                    gelöscht.
                                </div>
                                <div class="modal-footer">
                                    <form action="delete.php" method="post">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen
                                        </button>
                                        <button name="delete" type="submit" class="btn btn-primary">Löschen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="far fa-edit" data-toggle="modal" data-target="#rename-modal-<?=$root['ID']?>"></button>
                    <div class="modal fade" id="rename-modal-<?=$root['ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ordner umbenennen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload-file"></label>

                                        <form action="umbenennen.php?ordnerid=<?=$root['ID']?>" method="post">
                                            <input type="text" name="neuername" class="form-control">
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <input type="submit" value="Umbenennen" name="submit" class="btn btn-primary"> </input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>

        <?php

        $statement=$db->prepare('SELECT Datei.ID, Datei.original_name, Datei.dateiname, Datei.OrdnerID, Datei.OwnerID, Nutzer.vorname, Datei.Freigabe FROM Datei, Nutzer WHERE Datei.OwnerID=Nutzer.ID and (Datei.OwnerID=? and Datei.OrdnerID '.$operator.' ?) '); // user id eingefügt mit der ich eingeloggt bin
        $statement->bindParam(1, $userid);
        $statement->bindParam(2,$ordnerid);
        $statement->execute();
        //print_r ($statement->fetchAll());
        foreach($statement->fetchAll() as $root) {

            ?>


            <tr>
                <td><i class="far fa-file" style="margin-right:25px; "></i>
                    <a href="https://mars.iuk.hdm-stuttgart.de/~tb123/cleo/uploads/<?=$root['dateiname']?>" style="color: black; text-decoration:none;"><?=$root['original_name']?></a>
                </td>

                <!--Benutzername-->
                <td>
                    <?=$root['vorname']?>
                </td>

                <td>
                    <button type="button" class="far fa-trash-alt" data-toggle="modal" data-target="#delete-file-modal-<?=$root['ID']?>"></button>
                    <div class="modal fade" id="delete-file-modal-<?=$root['ID']?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Bist Du dir sicher?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Wenn Du auf "Löschen" klickst, wird die von Dir ausgewählte Datei unwiederruflich
                                    gelöscht.
                                </div>
                                <div class="modal-footer">
                                    <form action="delete.php?delete=<?= $root['dateiname']  ?>&ordnerid=<?= $ordnerid?>" method="post">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen
                                        </button>
                                        <button name="delete" type="submit" class="btn btn-primary">Löschen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---Funktion: Download--->
                    <form style="display:inline" action="download.php?dateiname=<?=$root['dateiname']?>" method="post">
                        <button type="submit" class="fas fa-arrow-down" style="padding-right: 10px; padding-left:10px;"></button>
                    </form>


                    <!-- Pop-Up für die Funktion: Teilen-->
                    <button type="button" class="fas fa-share-alt" data-toggle="modal" data-target="#share-modal-<?=$root['ID']?>"></button>
                    <div class="modal fade" id="share-modal-<?=$root['ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Teile Deine Ideen...</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload-file"></label>

                                        <form action="teilen.php?dateiid=<?=$root['ID']?><?php
                                        if(isset($_GET['ordnerid'])){
                                            echo '&ordnerid='.$_GET['ordnerid'];
                                        }
                                        ?>" method="post">
                                            <p class="teilen">Freunde, mit denen Du bereits teilst:</p>
                                            <ul class="list-group" style="max-height: 300px;">

                                                    <?php
                                                    $dateiid=$root['ID'];

                                                    $statement1=$db->prepare('SELECT Freigabe.ID, Freigabe.UserID, Nutzer.vorname, Nutzer.nachname FROM Freigabe INNER JOIN Nutzer ON (Nutzer.ID=Freigabe.UserID) WHERE Freigabe.DateiID=?');
                                                    $statement1->bindParam(1,$dateiid);
                                                    $statement1->execute();
                                                    $ergebnis=$statement1->fetchAll();
                                                    foreach ($ergebnis as $aktuell){
                                                        echo '<li class="list-group-item">';
                                                        echo $aktuell ['vorname'].' '.$aktuell['nachname'].'<a class="btn button-delete" href="delete-geteilt.php?delete='.$dateiid.'&userid='.$aktuell['UserID'];
                                                     if(isset($_GET['ordnerid'])){
                                                        echo '&ordnerid='.$_GET['ordnerid'];
                                                     }
                                                        echo '"><i class="far fa-times-circle" style="float: right"></i></a></li>';
                                                    }
                                                    ?>

                                            </ul>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">E-Mail Adresse:</label>
                                                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="beispiel@email.de">
                                            </div>
                                            <hr>
                                            <p class="teilen">Teilen mit fremden Personen</p>
                                            <div class="form-check">
                                                <input <?php
                                                if ( $root['Freigabe']=='1' ){
                                                    echo'checked';
                                                }
                                                ?> class="form-check-input" name="freigabe" type="checkbox" value="1" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Teilen mit fremden Personen erlauben
                                                </label>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">E-Mail Adresse:</label>
                                                <input type="email" class="form-control" id="exampleFormControlInput1" name="fremder" placeholder="beispiel@email.de">
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <input type="submit" value="Bestätigen" name="submit" class="btn btn-primary"> </input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="fas fa-share" data-toggle="modal" data-target="#move-modal-<?=$root['ID']?>"></button>
                    <div class="modal fade" id="move-modal-<?=$root['ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Datei verschieben nach...</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload-file"></label>

                                        <form action="verschieben.php?dateiid=<?=$root['ID']?>" method="post">
                                            <input type="text" name="ordnername" class="form-control">
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <input type="submit" value="Verschieben" name="submit" class="btn btn-primary"> </input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>


        <!---Freigegebene Dateien--->
        <?php
        if($ordnerid==NULL):

        $statement=$db->prepare('SELECT Datei.ID, Datei.original_name, Datei.dateiname, Datei.OrdnerID, Datei.OwnerID, Nutzer.vorname, Datei.Freigabe
                                          FROM Datei
                                          INNER JOIN Nutzer ON (Datei.OwnerID=Nutzer.ID) 
                                          INNER JOIN Freigabe ON (Datei.ID=Freigabe.DateiID)
                                          WHERE Freigabe.UserID=?'); // user id eingefügt mit der ich eingeloggt bin
        $statement->bindParam(1,$userid);
        $statement->execute();

        foreach($statement->fetchAll() as $root) {

            ?>


            <tr>
                <td><i class="far fa-file" style="margin-right:25px; "></i>
                    <?=$root['original_name']?>
                </td>

                <!--Benutzername-->
                <td>
                    <?=$root['vorname']?>
                </td>

                <td>
                    <button type="button" class="far fa-trash-alt" data-toggle="modal" data-target="#delete-file-modal-<?=$root['ID']?>"></button>
                    <div class="modal fade" id="delete-file-modal-<?=$root['ID']?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Bist Du dir sicher?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Abbrechen">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Wenn Du auf "Löschen" klickst, wird die von Dir ausgewählte Datei unwiederruflich
                                    gelöscht.
                                </div>
                                <div class="modal-footer">
                                    <form action="delete-geteilt.php?delete=<?= $root['ID']  ?>" method="post">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen
                                        </button>
                                        <button name="delete" type="submit" class="btn btn-primary">Löschen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---Funktion: Download--->
                    <form style="display:inline" action="download.php?dateiname=<?=$root['dateiname']?>" method="post">
                        <button type="submit" class="fas fa-arrow-down" style="padding-right: 10px; padding-left:10px;"></button>
                    </form>
                </td>
            </tr>
            <?php
        }
        endif;
        ?>



        </tbody>
    </table>
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

?>