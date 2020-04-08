<?php
require('action/dbconnection.php');
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
        header("Location: index1.php");
        die();
    }
}
else {
    header("Location: index1.php");
    die();
}
?>

<html>
<head>
    <title>Accountbeheer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/stylesheet.css">
    <!-- Bootstrap CSS importeren. -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .col-sm-8{
            width: 80%;
            margin: auto;

            align-content: center;
        }
        .terug {
            background-color: #4CAF50;
            color: white;
            padding: 5px;
            margin: 5px ;
            border: none;
            cursor: pointer;
            width: 10%;
            float: left;
        }
        .bijwerken{
            border-color: #007bff;
            background-color: white;
            color: #007bff;
            padding: 5px;
            margin: 5px ;
            border: none;
            cursor: pointer;
            width: 10%;
            float: left;
        }

    </style>
</head>

<body>
<div class="col-sm-8">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th colspan="1" class="text-center">Gebruikersnaam</th>
            <th colspan="1" class="text-center">E-mail</th>
            <th colspan="1" class="text-center">Wachtwoord</th>
            <th colspan="1" class="text-center">Admin</th>
        </tr>

            <?php
            $beheerder = $conn->query("SELECT * FROM gebruikers ");
            foreach ($beheerder as $gebruiker){
                $Admin = $gebruiker[4];
                if ($Admin == 0){
                    $Admin = "true";
                }else{
                    $Admin = "false";
                }
                ?>
                <tr>
                    <th colspan="1" class="text-center"><?php echo $gebruiker[2] ?></th>
                    <th colspan="1" class="text-center"><?php echo $gebruiker[1] ?></th>
                    <th colspan="1" class="text-center"><?php echo $gebruiker[3] ?></th>
                    <th colspan="1" class="text-center"><?php echo $Admin ?></th>
                </tr>

            <?php
            }

            ?>

        </thead>
    </table>
    <a href="licenties.php"><button class="terug">terug</button></a>
    <button class="bijwerken">bijwerken?</button>
    <button class="terug" style="width: auto">Nieuwe beheerder toevoegen</button>
</div>



</body>

</html>
