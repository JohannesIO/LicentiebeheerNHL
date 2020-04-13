<?php
    require('action/dbconnection.php');
    require('includes/beveiliging.php');
?>
<html>
    <title>Licentiebeheer - Accountbeheer</title>
        <?php include "includes/head.php"; ?>
    <body>
    <?php include "includes/navbar.php"; 
	$SessionID = $_COOKIE['SessionID'];
    $query = $conn->prepare("SELECT gebruikersnaam FROM sessions WHERE cookie='$SessionID'");
    $query->execute();
	$result = $query->fetch();

	$User = $result['gebruikersnaam'];
	$beheerder = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam='$User'");
	$beheerder->execute();
	$isadmin = $beheerder->fetch();

	?>
    <script>$("#nav-acc").addClass( "active" );</script>
    <br />
        <div class="container">

			

			<h5 class="text-left">Wachtwoord Reset</h5>
			<form method="post" action="action/action.php?a=change"  id="passwordForm">
				<br><input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Nieuw Wachtwoord" autocomplete="off" required>
				<br><input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" value="Submit">
			</form>

            
			



        </div>
    </body>
</html>
