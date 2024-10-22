<?php
    require('action/dbconnection.php');
    require('includes/beveiligingIndex.php');
?>

<!DOCTYPE html>
<html>
<title>Licentiebeheer - Inloggen</title>
<?php include "includes/head.php"; ?>
<link rel="stylesheet" type="text/css" href="assets/stylesheet/signin_stylesheet.css">
<body class="text-center">
<form class="form-signin" action="action/action.php?a=login" method="post">

    <img class="mb-3" src="assets/images/NHLSTENDEN_LOGO.png" alt="NHL Stenden" width="160" height="125">

    <h1 class="h3 mb-3 font-weight-normal">Licentiebeheer</h1>

    <label for="inputEmail" class="sr-only">E-mail</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
    <label for="inputPassword" class="sr-only">Wachtwoord</label>
    <input type="password" name="wachtwoord" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>

    <input type="submit" class="btn btn-lg btn-primary btn-block" name="login_submit" value="Inloggen">

    <!--<a href="wachwoordvergeten.php">Wachtwoord vergeten?</a><br />-->
    <p class="mt-5 mb-3 text-muted">Groep 22 &copy; 2020</p>
</form>
</body>
</html>
