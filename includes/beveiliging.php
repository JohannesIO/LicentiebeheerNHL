<?php
// Eerst beveiliging check
if (isset($_COOKIE['SessionID'])) {
    //TODO: beter checken naar potentiele injectie.
    $session_ID_var = htmlspecialchars($_COOKIE['SessionID']);
    //Checken of session bestaat dmv cookie hash.
    $checkSessionQuery = "SELECT * FROM sessions WHERE cookie = '$session_ID_var'";
    $checkSessionResult = $conn->prepare($checkSessionQuery);
    $checkSessionResult->execute();
    $number_of_rows = $checkSessionResult->fetchColumn();
    // Checken of query is uitgevoerd && cookie in sessions tabel staat.
    // Als cookie niet in database staat, redirecten naar index.php
    if ($checkSessionQuery && $number_of_rows == 0) {
        unset($_COOKIE['SessionID']);
        setcookie('SessionID', null, -1, '/');
        header("Location: index.php");
        die();
    }
    else {
        // Userdata verkrijgen.
        $checkSessionResult->execute();
        $userData = $checkSessionResult->fetch();
        }
}
    else {
        header("Location: index.php");
        die();
    }
?>