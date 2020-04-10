<?php
    //Checken of SessionID cookie bestaat.
    if (isset($_COOKIE['SessionID'])) {
        //TODO: beter checken naar potentiele injectie.
        $session_ID_var = htmlspecialchars($_COOKIE['SessionID']);
        //Checken of session bestaat dmv cookie hash.
        $checkSessionQuery = "SELECT * FROM sessions WHERE cookie = '$session_ID_var'";
        $checkSessionResult = $conn->prepare($checkSessionQuery);
        $checkSessionResult->execute();
        $number_of_rows = $checkSessionResult->fetchColumn();
        // Checken of query is uitgevoerd && cookie in sessions tabel staat.
        if ($checkSessionQuery && $number_of_rows != 0) {
            header("Location: licenties.php");
            die();
        }
    }