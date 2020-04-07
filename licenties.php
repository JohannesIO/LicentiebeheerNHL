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


session_start();

if (empty($_SESSION['LicentieID']))
	$_SESSION['LicentieID'] = 0;
$licentie = $conn->query("SELECT * FROM licenties WHERE licentieid=".$_SESSION['LicentieID']."");
$licentieSel = $licentie->fetch();

?>

<html>

<head>
    <title>Licenties</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/stylesheet.css">
    <!-- Bootstrap CSS importeren. -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="licenties.php">Licentiebeheer.</a>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Account beheren.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="action/action.php?a=logout">Logout.</a>
                </li>
            </ul>
            <span class="navbar-text" style="cursor: default;">
                Welkom <b><?php echo $userData['gebruikersnaam'];  ?></b>.
            </span>
        </div>

    </nav>
    <br />
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-hover" id="licentieTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Licenties</th>
                        </tr>
                    </thead>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                            placeholder="Licentie zoeken... [WIP]">
                    </div>
                    <tbody>
                        <?php
                            $licenties = $conn->query("SELECT * FROM licenties");
                            while($row = $licenties->fetch()) {
                                $licentieID = $row[0];
                                $licentieNummer = $row[1];
                                echo "
                                            <tr class='licentieTable' id=" . $licentieID . ">
                                            <td >" . $row[4] . "</form></td>
                                            </tr>                               
                                      
                                      <script>
                                        $('#" . $licentieID . "').click(function () {
                                            $.get('action/action.php?a=select&licentieID=" . $licentieID . "')

                                            location.reload();
                                        });
                                    </script>      
                                     ";
                            }
                        ?>
                    </tbody>
                </table>

                <div class="row">
                    <button type="button" class="btn btn-success btn-block" id="hide" style="margin: 5px">Licentie
                        toevoegen in/uitklappen</button>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <form class="form-signin" action="" method="post" style="margin: 5px">
                        <input type="submit" class="btn btn-info" style="margin: 5px" value="Bijwerken"
                            name="bijwerk_button" />
                    </form>

                    <form class="form-signin" action="action/action.php?a=delete" method="post" style="margin: 5px">
                        <input type="submit" class="btn btn-danger" style="margin: 5px" value="Verwijderen"
                            name="delete_button" />
                    </form>

                    <label style="margin: 5px">Binnenkort verloopt: Licentie X en Licentie Y</label>


                </div>

                <table class="table table-bordered" id="licentieDisplay">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Naam licentie <br>
                                <?php echo $licentieSel['licentienaam'] ?></th>
                        </tr>
                        <tr>
                            <th>Doelgroep <br>
                                <?php echo 'doelgroep1' ?></th>
                            <th>Hoofdgebruiker <br>
                                <?php echo $licentieSel['hoofdgebruiker'] ?></th>
                        </tr>
                        <tr>
                            <th rowspan="2">Beschrijving <br>
                                <?php echo $licentieSel['licentiebeschrijving'] ?></th>
                            <th>Licentiecode <br>
                                <?php echo $licentieSel['licentienummer'] ?></th>
                        </tr>
                        <tr>
                            <th>Verleng uitleg <br>
                                <?php echo 'verleng uitleg 1' ?></th>
                        </tr>
                        <tr>
                            <th>Vervaldatum <br>
                                <?php echo $licentieSel['vervaldatum'] ?></th>
                            <th>Installatie uitleg <br>
                                <?php echo $licentieSel['installatieuitleg'] ?></th>
                        </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <form action="action/action.php?a=toevoegen" method='post' id="toevoegen">
                    <div class="row-">
                        <div class="form-group">
                            <textarea class="form-control text-center" name="LNaam" id="" rows="1"
                                placeholder="Naam Licentie" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea class="form-control" name="LDoelGroep" id="" rows="1"
                                    placeholder="Doelgroep"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="LBeschr" id="" rows="12"
                                    placeholder="Beschrijving"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="date" name="LVerval" id="LVerval" rows="1"
                                    title="Verval datum" data-toggle="tooltip" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea class="form-control" name="LHGebr" id="" rows="1"
                                    placeholder="Hoofdgebruiker"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="LCode" id="" rows="2"
                                    placeholder="Licentiecode" required></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="LVerleng" id="" rows="4"
                                    placeholder="Verleng uitleg"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="LInstall" id="" rows="6"
                                    placeholder="Installatie uitleg"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" form="toevoegen" name="Toevoegen" value="Nieuw"
                        class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>



        <script>
            $(document).ready(function () {
                var hideBool = true;
                var toevoegen = $("#toevoegen");
                var licentieTable = $("#licentieTable");
                var licentieDisplay = $("#licentieDisplay");

                $(hideElements);

                $("#hide").click(function () {
                    hideBool = !hideBool
                    $(hideElements);
                })

                function hideElements() {
                    if (hideBool == true) {
                        $(toevoegen).hide();
                        $(licentieDisplay).show();
                        $(licentieTable).show();
                    }
                    else {
                        $(licentieTable).hide();
                        $(licentieDisplay).hide();
                        $(toevoegen).show();
                    }
                }

                $('#LVerval').tooltip();
            });

        </script>
</body>

</html>
