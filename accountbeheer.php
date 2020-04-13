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

	if ($isadmin['isAdmin'] == 0){
		echo"<script> var hideBool = true; </script>";
	};
	?>
    <script>$("#nav-acc").addClass( "active" );</script>
    <br />
        <div class="container">

            <div class="col-sm Admin">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th colspan="1" width="35%" class="text-center"><b>Gebruikersnaam</b></th>
                        <th colspan="1" width="35%" class="text-center"><b>E-mail</b></th>
                        <th colspan="1" width="15%" class="text-center"><b>Adminrechten</b></th>
						<th colspan="1" width="15%" class="text-center"><b>Wijzigen</b></th>
                    </tr>

                        <?php
                        $beheerder = $conn->query("SELECT * FROM gebruikers ");
                        foreach ($beheerder as $gebruiker){
                            $Admin = $gebruiker[4];

							echo "<tr id='accountbeheer' style='font-weight: normal;'>
                                <th colspan='1' class='text-center'>". $gebruiker[2] . "</th>
                                <th colspan='1' class='text-center'>". $gebruiker[1] . "</th>";
							
							echo "<th class='text-center'>";
							if ($Admin == 1) {
								echo "<form method='post' action='action/action.php?a=adminchange' name='AdminForm' id='AdminForm'>";
								echo "<input class='form-control' name='uncheck' id='uncheck' value='" . $gebruiker[0] ."' hidden></textarea>";
								echo "<input type='checkbox' onchange='this.form.submit();'checked> </th>";
							}
							else { 
								echo "<form method='post' action='action/action.php?a=adminchange' name='AdminForm' id='AdminForm'>";
								echo "<input class='form-control' name='check' id='check' value='" . $gebruiker[0] ."' hidden></textarea>";
								echo "<input type='checkbox' onchange='this.form.submit();'> </th>";
                            }
							echo "</form>";
							
							
							echo "<form method='post' action='action/action.php?a=deluser' name='DelUser' id='DelUser'>";
							echo "<th class='text-center'>";
							echo "<input class='form-control' name='UserID' id='UserID' value='" . $gebruiker[0] ."' hidden></textarea>";
							echo '<button type="submit" name="Del" value="Del" class="btn btn-danger">Verwijderen</button>';
							echo "</th> </form>";

                            echo "</tr>";

                        }
						
                        ?>

                    </thead>
                </table>
                <a href="licenties.php"><button class="accountbeheerTerug">terug</button></a>
                <button class="accountbeheerBijwerken">bijwerken?</button>
                <button class="accountbeheerTerug" style="width: auto">Nieuwe beheerder toevoegen</button>
            </div>
			<br><br>

			<h5 class="text-left">Nieuwe Gebruiker</h5>
			<form method="post" action="action/action.php?a=newuser"  id="NewUserForm">
				<br><input type="text" class="input-lg form-control" name="Username" id="Username" placeholder="Gebruikernaam" autocomplete="off">
				<br><input type="text" class="input-lg form-control" name="EMail" id="EMail" placeholder="E-Mail" autocomplete="off">
				<br><input type="password" class="input-lg form-control" name="Password" id="Password" placeholder="Wachtwoord" autocomplete="off">
				<br><input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" value="Submit">
			</form>
			<br><br>

			<h5 class="text-left">Wachtwoord Reset</h5>
			<form method="post" action="action/action.php?a=change"  id="passwordForm">
				<br><input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Nieuw Wachtwoord" autocomplete="off">
				<br><input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" value="Submit">
			</form>



        </div>
        <script>


            $(document).ready(function () {
                
                var Admin = $(".Admin");

				$(hideElements);

                function hideElements() {
                    if (hideBool == true) {
                        $(Admin).hide();

                    }
                    else {
                        $(Admin).show();
                    }
                }
            });
        </script>
    </body>
</html>
