<link rel="stylesheet" type="text/css" href="/licentiebeheer/assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
<?php
// Database connectie importeren
require("dbconnection.php");
// Als gebruiker naar action.php probeert te gaan 404 geven
if (!isset($_GET['a'])) {
    die("404 - NOT FOUND.");
}
// action.php?a=login = Login() functie
if($_GET['a'] == 'login'){
    Login();
}
if($_GET['a'] == 'logout'){
    Logout();
}
if($_GET['a'] == 'toevoegen'){
    Toevoegen();
}
if($_GET['a'] == 'select'){
    Select();
}
if($_GET['a'] == 'delete'){
    Delete();
}
if($_GET['a'] == 'edit'){
    Edit();
}



function Login() {
    // $conn (databaseconnectie) importeren in deze functie, omdat hij buiten de scope staat
    global $conn;
    // Checken of gebruiker wel van de inlog pagina komt
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        // Checken of velden niet leeg zijn
        if(empty($_POST['email'] && $_POST['wachtwoord'])) {
            echo "Niet alle velden zijn ingevuld, <br/> <a href='/licentiebeheer/index.php'>Klik hier om terug te gaan.</a>";
        }
        else {
            //TODO: betere beveiliging van de strings.
            //TODO: hash aan password toevoegen.
            $login_email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
            $login_wachtwoord = filter_var($_POST["wachtwoord"], FILTER_SANITIZE_STRING);
            // Checken of ingevulde email en wachtwoord in de database staan.
            $login_query = $conn->prepare("SELECT * FROM gebruikers WHERE email = '$login_email'");
            $login_query->execute();
            $number_of_rows = $login_query->fetchColumn();
            if($login_query && $number_of_rows != 0) {
                $login_query->execute();
                $login_result = $login_query->fetch();
                $getHashedPassword = $login_result['wachtwoord'];
                if(password_verify($login_wachtwoord, $getHashedPassword)) {
                    $login_gebruikersnaam = $login_result['gebruikersnaam'];
                    //Cookie aanmaken met een gegenereerde code, om zo overal te kunnen checken of de gebruiker wel ingelogd is d.m.v. de cookiehash en de database te checken.
                    $session_cookie_gen = sha1( microtime() . $login_email . rand(111111, 999999)); // milliseconden + username en een willekeurig getal tussen 111111 en 999999 gecodeerd in sha1.
                    // Cookie in database plaatsen.
                    // TODO: gebruikersnaam ook in session plaatsen.
                    $session_query = "INSERT INTO sessions (`gebruikersnaam`, `email`,  `cookie`) VALUES ('$login_gebruikersnaam', '$login_email',  '$session_cookie_gen')";
                    $session_result = $conn->prepare($session_query);
                    $session_result->execute();
                    //Cookie daadwerkelijk aanmaken. 3600 seconden is 1 uur
                    setcookie('SessionID', $session_cookie_gen, time() + 3600, "/");
                    //Doorsturen naar licenties.php
                    header("Location: /licentiebeheer/licenties.php");
                    die();
                }
                else {
                    echo "password verify niet gelukt";
                }
            }
            else {
                echo "Onjuiste inloggegevens, <br/> <a href='/licentiebeheer/index.php'>Klik hier om terug te gaan.</a>";
                die();
            }

        }

    }
}

function Logout() {
	global $conn;
	$SessionID = $_COOKIE['SessionID'];
	$conn->exec("DELETE FROM sessions WHERE cookie='$SessionID'");
    unset($_COOKIE['SessionID']);
    setcookie('SessionID', null, -1, '/');
    header("Location: /licentiebeheer/index.php");
    die();
}

function Toevoegen() {
	require("dbconnection.php");
    //TODO: Je kan niet niet-gecheckte variabelen in je database zetten.

	$licentienummer = $_POST['LCode'];
	$vervaldatum = $_POST['LVerval'];
	$hoofdgebruiker = filter_var($_POST["LHGebr"], FILTER_SANITIZE_STRING);
	$licentienaam = filter_var($_POST["LNaam"], FILTER_SANITIZE_STRING);
	$licentiebeschrijving = filter_var($_POST["LBeschr"], FILTER_SANITIZE_STRING);
	$installatieuitleg = filter_var($_POST["LInstall"], FILTER_SANITIZE_STRING);
	$doelgroep = filter_var($_POST["LDoelGroep"], FILTER_SANITIZE_STRING);
	$verlenguitleg = filter_var($_POST["LVerleng"], FILTER_SANITIZE_STRING);

	$conn->exec("INSERT INTO licenties (licentienummer, vervaldatum, hoofdgebruiker, licentienaam, licentiebeschrijving, installatieuitleg, doelgroep, verlenguitleg) 
	VALUES ('$licentienummer', '$vervaldatum', '$hoofdgebruiker', '$licentienaam', '$licentiebeschrijving', '$installatieuitleg', '$doelgroep', '$verlenguitleg')");
	echo "<script>alert('licentie toegevoegd')</script>";
	header("Location: /licentiebeheer/licenties.php");
	die();
}


function Select() {
	session_start();
	$_GET['licentieID'];
	$_SESSION['LicentieID'] = $_GET['licentieID'];
	
	header("Location: /licentiebeheer/licenties.php");
	die();
}

function Delete() {
	require("dbconnection.php");
	session_start();
	$licentieid = $_SESSION['LicentieID'];
	$conn->exec("DELETE FROM licenties WHERE licentieid=$licentieid");
	header("Location: /licentiebeheer/licenties.php");
	die();
}

function Edit() { 
	require("dbconnection.php");
	session_start();

	$licentieid = $_SESSION['LicentieID'];
	$licentienummer = $_POST['LCode'];
	$vervaldatum = $_POST['LVerval'];
	$hoofdgebruiker = filter_var($_POST["LHGebr"], FILTER_SANITIZE_STRING);
	$licentienaam = filter_var($_POST["LNaam"], FILTER_SANITIZE_STRING);
	$licentiebeschrijving = filter_var($_POST["LBeschr"], FILTER_SANITIZE_STRING);
	$installatieuitleg = filter_var($_POST["LInstall"], FILTER_SANITIZE_STRING);
	$doelgroep = filter_var($_POST["LDoelGroep"], FILTER_SANITIZE_STRING);
	$verlenguitleg = filter_var($_POST["LVerleng"], FILTER_SANITIZE_STRING);

	$sql = "UPDATE Licenties SET 
	licentienummer='$licentienummer', 
	vervaldatum='$vervaldatum', 
	hoofdgebruiker='$hoofdgebruiker', 
	licentienaam='$licentienaam', 
	licentiebeschrijving='$licentiebeschrijving', 
	installatieuitleg='$installatieuitleg',
	doelgroep='$doelgroep', 
	verlenguitleg='$verlenguitleg'
	WHERE licentieid=$licentieid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
	

	echo "<script>alert('Licentie Bijgewerkt')</script>";
	header("Location: /licentiebeheer/licenties.php");
	die();
}