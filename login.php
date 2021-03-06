<?php
session_start();
require_once('config.inc.php');

if(isset($_POST['absenden'])){
    $email = strtolower($_POST['email']);
    $passwort = $_POST['passwort'];
    $passwort = md5($passwort);

    $search_user = $db->prepare("SELECT * FROM Nutzer WHERE email = :email AND passwort = :passwort");
    $result = $search_user->execute(array('email' => $email, 'passwort' => $passwort));
    $search_result = $search_user-> fetch();


    if ($search_result !== false) {
        $_SESSION['user'] = $search_result['ID'];
        header('Location: hauptseite.php');
        die();
    } else {
        $errorMessage = "";
    }

}

?>

<!doctype html>
<html lang="de">
<head>
<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- All CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="login.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.dialog.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.resizable.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Megrim" rel="stylesheet">
<title>Cleo Login</title>

<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<!-- <script src="jQueryAssets/jquery-1.11.1.min.js"></script> -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.dialog.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>


</head>


<body class="text-center">



<section id="headline">
  <h1>Willkommen bei</h1>
</section>


<img class="m-5 rounded mx-auto d-flex img-fluid" src="https://mars.iuk.hdm-stuttgart.de/~sg151/cleo_logo_final.png" alt="" width="350" height="auto">

<?php

if(isset($errorMessage)):

    ?>

    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <h3 class="alert-heading"><i class="fas fa-sad-tear"></i></h3>
        <hr>
        <h4>Oh crap! Deine Anmeldedaten sind leider nicht gültig.</h4>
        <p class="mb-0">Check doch kurz <strong>deine Email</strong> oder <strong>dein Passwort</strong> und versuche es nochmal.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php

endif;
?>

<!-- Formular -->
<section id="form">
  <form class="form-signin" action="" method="post">
  <h2 class="h3 m-0 font-weight-light"><strong>Bitte anmelden</strong></h2>
  <label for="inputEmail" class="sr-only">Email</label>
  <input type="email" name="email" class="form-control" placeholder="Deine Email Adresse" required autofocus>

  <label for="inputPassword" class="sr-only">Passwort</label>
  <input type="password" name="passwort" class="form-control" placeholder="Passwort" required>



      <button class="btn btn-lg btn-primary btn-block" name="absenden" type="submit">Loslegen</button>
      <a href="registrieren.php" class="mt-3 btn btn-outline-info">Du hast noch kein Konto?</a>

  <p class="mt-3 mb-5 text-muted" id="subtext">Cleo 2018</p>


 </form>


</section>



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
            <div class="col-xs-12 col-sm-4 col-md-4 mt-8">
                <h5>Allgemeines</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="about_us.php"><i class="fa fa-angle-double-right"></i>Über uns</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>Datenschutz</a></li>
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


</footer>
<!-- ./Footer -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="js/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</script>
</body>
</html>