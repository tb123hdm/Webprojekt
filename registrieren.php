<?php
session_start();
require_once("config.inc.php");

?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- All CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="startseite.css"/>
	<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
	<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
	<link href="jQueryAssets/jquery.ui.dialog.min.css" rel="stylesheet" type="text/css">
	<link href="jQueryAssets/jquery.ui.resizable.min.css" rel="stylesheet" type="text/css">
	<link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
	<title>Cleo - Registrierung</title>
	<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
	<!-- <script src="jQueryAssets/jquery-1.11.1.min.js"></script> -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="jQueryAssets/jquery.ui-1.10.4.dialog.min.js"></script>
	<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>
	<script>
	<script>var __adobewebfontsappname__="dreamweaver"</script>
	<script src="http://use.edgefonts.net/advent-pro:n1,n2,n4:default;gfs-neohellenic:n4:default;homenaje:n4:default;boogaloo:n4:default;roboto:n4:default;over-the-rainbow:n4:default;fresca:n4:default;ubuntu-condensed:n4:default;josefin-sans:n1,n3:default;acme:n4:default;droid-sans:n4:default.js" type="text/javascript">
	</script>
	
</head>

<body class="text-center">
	<div id="willkommen">
		<h1> Hey willkommen bei Cleo</h1>
	</div>

	<?php
	$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

	if ( isset( $_GET[ 'register' ] ) ) {
		$error = false;
		$email = $_POST[ 'email' ];
		$passwort = $_POST[ 'passwort' ];
		$passwort2 = $_POST[ 'passwort2' ];

		if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
			$error = true;
		}
		if ( strlen( $passwort ) == 0 ) {
			echo 'Bitte ein Passwort angeben<br>';
			$error = true;
		}
		if ( $passwort != $passwort2 ) {
			echo 'Die Passwörter müssen übereinstimmen<br>';
			$error = true;
		}

		//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
		if ( !$error ) {
			$statement = $pdo->prepare( "SELECT * FROM Nutzer WHERE email = :email" );
			$result = $statement->execute( array( 'email' => $email ) );
			$user = $statement->fetch();

			if ( $user !== false ) {
				echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
				$error = true;
			}
		}

		//Keine Fehler, wir können den Nutzer registrieren
		if ( !$error ) {
			$passwort_hash = password_hash( $passwort, PASSWORD_DEFAULT );

			$statement = $pdo->prepare( "INSERT INTO Nutzer (email, passwort) VALUES (:email, :passwort)" );
			$result = $statement->execute( array( 'email' => $email, 'passwort' => $passwort_hash ) );

			if ( $result ) {
				echo 'Du wurdest erfolgreich registriert. <a href="login.html">Zum Login</a>';
				$showFormular = false;
			} else {
				echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
			}
		}
	}

	if ( $showFormular ) {
		?>


	<div id="form">
		<form class="form-signin" form action="?register=1" method="post">
			<img class="m-0 rounded mx-auto d-block" src="https://trello-attachments.s3.amazonaws.com/5ab8d1b9621426ac0cecd98f/5ad5f3bb3595e5656f80b07b/8130da7a33f0ff5294aab16f2d4bba86/Cleo_Logo_neu2.png" alt="" width="auto" height="200">
			<h1 class="h3 m-0 font-weight-light"><strong>Neu bei Cleo?</strong></h1>
			<label for="inputvorname" class="sr-only">vorname</label>
			<input type="text" id="vorname" class="form-control" placeholder="Vorname" required autofocus>

			<label for="inputname" class="sr-only">nachname</label>
			<input type="text" id="name" class="form-control" placeholder="Nachname" required autofocus>
			<br>

			<label for="inputEmail" class="sr-only">email</label>
			<input type="email" id="email" class="form-control" placeholder="Deine Email" required autofocus>
			<label for="inputPassword" class="sr-only">passwort</label>
			<input type="password" id="passwort" class="form-control" placeholder="Passwort" required>
			<label for="inputPassword" class="sr-only">passwort2</label>
			<input type="password" id="passwort2" class="form-control" placeholder="Wiederhole dein Passwort" required>

			<div class="checkbox mb-3">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Registrieren</button>
		</form>
		<p class="mt-3 mb-5 text-muted">Cleo 2018</p>
		</div>
	</div>
	<div id="footer">
		<div class="col-4 "> <a href="impressum.html"> Impressum </a> </div>
		<div class="col-4 "> Made with
			<3 in Stuttgart </div>
				<div class="col-4 "> Webprojekt @ HdM Stuttgart </div>
		</div>

		<?php
		} //Ende von if($showFormular)
		?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="js/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
		</script>
</body>
</html>