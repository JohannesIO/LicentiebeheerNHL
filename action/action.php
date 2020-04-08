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

function Login() {
    // $conn (databaseconnectie) importeren in deze functie, omdat hij buiten de scope staat
    global $conn;
    // Checken of gebruiker wel van de inlog pagina komt
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        // Checken of velden niet leeg zijn
        if(empty($_POST['email'] && $_POST['wachtwoord'])) {
            echo "Niet alle velden zijn ingevuld, <br/> <a href='index.php'>Klik hier om terug te gaan.</a>";
        }
        else {
            //TODO: betere beveiliging van de strings.
            //TODO: hash aan password toevoegen.
            $login_email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
            $login_wachtwoord = filter_var($_POST["wachtwoord"], FILTER_SANITIZE_STRING);
            // Checken of ingevulde email en wachtwoord in de database staan.
            $login_query = "SELECT * FROM gebruikers WHERE email = '$login_email' AND wachtwoord = '$login_wachtwoord'";
            $login_result = $conn->prepare($login_query);
            $login_result->execute();
            $number_of_rows = $login_result->fetchColumn();
            // Checken of query is uitgevoerd && user in de database staat.
            if ($login_query && $number_of_rows != 0) {
                //Cookie aanmaken met een gegenereerde code, om zo overal te kunnen checken of de gebruiker wel ingelogd is d.m.v. de cookiehash en de database te checken.
                $session_cookie_gen = sha1( microtime() . $login_email . rand(111111, 999999)); // milliseconden + username en een willekeurig getal tussen 111111 en 999999 gecodeerd in sha1.
                // Cookie in database plaatsen.
                // TODO: gebruikersnaam ook in session plaatsen.
                $session_query = "INSERT INTO sessions (`email`, `cookie`) VALUES ('$login_email', '$session_cookie_gen')";
                $session_result = $conn->prepare($session_query);
                $session_result->execute();
                //Cookie daadwerkelijk aanmaken. 3600 seconden is 1 uur
                setcookie('SessionID', $session_cookie_gen, time() + 3600, "/");
                //Doorsturen naar licenties.php
                header("Location: /licenties.php");
                die();
            }
            else {
                echo "Onjuiste inloggegevens, <br/> <a href='index.php'>Klik hier om terug te gaan.</a>";
                die();
            }

        }

    }
}

function Logout() {
    unset($_COOKIE['SessionID']);
    setcookie('SessionID', null, -1, '/');
    echo "gelukt";
    header("Location: /index.php");
    die();
}