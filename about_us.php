<?php
session_start();
require_once('config.inc.php');
$userid = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cleo - Über Uns</title>

    <link rel="stylesheet" type="text/css" href="hauptseite_test.css">
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <style>
        html {
            font-size: 1rem;
        }

        @include media-breakpoint-up(sm) {
            html {
                font-size: 1.2rem;
            }
        }
        @include media-breakpoint-up(md) {
            html {
                font-size: 1.4rem;
            }
        }

        @include media-breakpoint-up(lg) {
            html {
                font-size: 1.6rem;
            }
        }

        body{
            height: 1000px;
            background-color: #eeeeee;
        }
        footer{
            background-color: #333a40;
            height: 300px;
        }
        p{
            color: lightgrey;
            font-family: 'Open Sans Condensed', sans-serif;
            letter-spacing: 1px;
            font-size: large;
        }
        h2{
            font-size: xx-large;
            margin: 50px;
        }
        h3{
            font-family: 'Megrim', cursive;
            color: white;
        }
        h4 {
            font-family: 'Megrim', cursive;
        }
        h5{
            font-family: 'Questrial', sans-serif;
            font-weight: 200;
            letter-spacing: 1px;
        }
        .card-deck{
            margin-right: 50px;
            margin-left: 50px;
            margin-top: auto;
            margin-bottom: 100px;

        }
        .zitat{
            font-family: 'Slabo 27px', serif;
            font-weight: lighter;
            font-size: x-large;
            text-align: center;
            background-color: rosybrown;
            color: white;
            height: 300px;
            padding: 50px;
        }


        /* Footer */
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        section {
            padding: 60px 0;
        }

        section .section-title {
            text-align: center;
            color: #007b5e;
            margin-bottom: 50px;
            text-transform: uppercase;
        }
        #footer {
            background: #333a40;
        }
        #footer h5{
            padding-left: 10px;
            padding-bottom: 6px;
            margin-bottom: 20px;
            color:white;
            font-family: 'Open Sans Condensed', sans-serif;
            letter-spacing: 1px;
        }
        #footer a {
            color: #ffffff;
            text-decoration: none !important;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }
        #footer ul.social li{
            padding: 3px 0;
        }
        #footer ul.social li a i {
            margin-right: 5px;
            font-size:25px;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #footer ul.social li:hover a i {
            font-size:30px;
            margin-top:-10px;
        }
        #footer ul.social li a,
        #footer ul.quick-links li a{
            color:#ffffff;
        }
        #footer ul.social li a:hover{
            color:#eeeeee;
        }
        #footer ul.quick-links li{
            padding: 3px 0;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
            font-family: 'Open Sans Condensed', sans-serif;
            letter-spacing: 2px;
        }
        #footer ul.quick-links li:hover{
            padding: 3px 0;
            margin-left:5px;
            font-weight:700;
        }
        #footer ul.quick-links li a i{
            margin-right: 5px;
        }
        #footer ul.quick-links li:hover a i {
            font-weight: 700;
        }

        @media (max-width:767px){
            #footer h5 {
                padding-left: 0;
                border-left: transparent;
                padding-bottom: 0;
                margin-bottom: 10px;
            }
        }
    </style>

<body>

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
                        echo '<img src="Media/standardbild.jpg"  width="50" height="50" class="rounded-circle mr-3" alt=""  >';
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
        <br>


            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" data-toggle="modal" data-target="#folder-modal"><i class="fas fa-folder" style="margin-right: 10px"></i>Ordner erstellen</button>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item" data-toggle="modal" data-target="#upload-modal"><i class="fas fa-file-upload" style="margin-right: 10px"></i>Datei hochladen</button>
            </div>
        <br>
</nav>
</header>

<h2 id="header-about" style="font-family: 'Poppins', sans-serif">Das Team</h2>

    <!--Team-Bilder--->
    <div class="card-deck">
        <div class="card">
            <img class="card-img-top" src="Media/Tabea%20Baranek.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Tabea Baranek</h5>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="Media/Sebastian%20Gröner.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Sebastian Gröner</h5>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="Media/Ellie%20Rodriguez.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Elina Rodriguez</h5>
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
            </hr>
        </div>
    </div>
</section>
<!-- ./Footer -->
</body>
</html>