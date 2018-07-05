<!Doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- All CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login_test.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.dialog.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.resizable.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
    <title>Cleo - Login</title>

    <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
    <!-- <script src="jQueryAssets/jquery-1.11.1.min.js"></script> -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="jQueryAssets/jquery.ui-1.10.4.dialog.min.js"></script>
    <script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>


</head>
<body background="blur.jpg" style="background-repeat: no-repeat; background-size: cover">
<div class="row">
    <div class="col-12">
        <?php

        if(isset($errorMessage)) {
            echo $errorMessage;
        }
        ?>

        <img class="m-5 rounded mx-auto d-flex img-fluid" src="logo_leer.png" alt="" width="150" height="auto">

        <!-- Formular -->
        <section id="form">
            <form class="form-signin" action="" method="post">
                <h2 class="h3 m-0 font-weight-light" style="color: white; font-size: medium; font-weight: lighter; text-align: center; font-family: 'Poppins', sans-serif; letter-spacing: 0.5px;">Bitte anmelden</h2>
                <br>
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Deine Email Adresse" required autofocus>
                <br>
                <label for="inputPassword" class="sr-only">Passwort</label>
                <input type="password" name="passwort" class="form-control" placeholder="Passwort" required>



                <button class="btn btn-lg btn-primary btn-block" name="absenden" type="submit">Loslegen</button>
                <a href="registrieren.php" class="mt-3 btn btn-outline-info" style="vertical-align: center">Du hast noch kein Konto?</a>

                <p id="text-muted">Cleo 2018</p>
                <br>
                <br>
            </form>
        </section>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-4 col-md-4 mt-8">
                <h3>C L E O</h3>
                <br>
                <p>Hochschule der Medien<br>
                    Nobelstraße 10<br>
                    70569 Stuttgart</p>
            </div>
            <div>
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
            </br>
        </div>
</footer>
<!-- ./Footer -->
</body>
</html>