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

$Date = date("Y/m/d");
$over7dagen = date('Y-m-d', strtotime($Date. ' +7 days')). "<br>";
$array = array();
$aantal = 0;
$licenties = $conn->query("SELECT vervaldatum, licentienaam  FROM licenties");
foreach ($licenties as $item) {

    if ($item[0] < $over7dagen){
        $aantal++;
        array_push($array, $item[1]);
    }else{

    }
}


if (!empty($_POST['Toevoegen'])){

    //TODO: Je kan niet niet-gecheckte variabelen in je database zetten.

	$licentienummer = $_POST['LCode'];
	$vervaldatum = $_POST['LVerval'];
	$hoofdgebruiker = $_POST['LHGebr'];
	$licentienaam = $_POST['LNaam'];
	$licentiebeschrijving = $_POST['LBeschr'];
	$installatieuitleg = $_POST['LInstall'];

	$conn->exec("INSERT INTO licenties (licentienummer, vervaldatum, hoofdgebruiker, licentienaam, licentiebeschrijving, installatieuitleg) 
	VALUES ('$licentienummer', '$vervaldatum', '$hoofdgebruiker', '$licentienaam', '$licentiebeschrijving', '$installatieuitleg')");
	echo "<script>alert('licentie toegevoegd')</script>";
}
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

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
                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Licentie zoeken... [WIP]">
                    </div>
                    <tbody>
                        <?php
                            $licenties = $conn->query("SELECT * FROM licenties");
                            while($row = $licenties->fetch()) {
                                $licentieNummer = $row[1];
                                echo "
                                            <tr class='licentieTable' id=" . $licentieNummer . ">
                                            <td>" . $row[4] . "</form></td>
                                            </tr>                               
                                      
                                      <script>
                                                $('#" . $licentieNummer . "').click(function() {
                                                    alert(" . $licentieNummer . ");
                                                });
                                      </script>      
                                     ";
                            }
                        ?>
                    </tbody>
                </table>

                <div class="row">
                    <button type="button" class="btn btn-success btn-block" style="margin: 5px">Licentie
                        toevoegen</button>
                </div>
                <div class="row">
                    <a href="accountbeheer.php"><button type="button" class="btn btn-primary btn-block" style="margin: 5px">Account beheren</button></a>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <button type="button" class="btn btn-outline-primary" style="margin: 5px">Bijwerken</button>
                    <button type="button" class="btn btn-danger" style="margin: 5px">Verwijderen</button>
                    <form class="form-signin" action="action/action.php?a=logout" method="post" style="margin: 5px">
                        <input type="submit" class="btn btn-primary" value="Logout" name="logout_button"  />
                    </form>

                    <label style="margin: 3px" class="p-3 mb-2 bg-danger text-white">
                    <?php
                    if ($aantal > 2){
                        ?>
                        <h10> de volgende licenties zullen binnenkort verlopen </h10>
                            <select id="licentienamen">
                                <?php
                                foreach ($array as $input){
                                    ?>
                                    <option><?php echo $input?></option>
                                <?php }?>
                            </select>

                            <?php
                        }else{
                        echo "De volgende licenties zullen binnen een week verlopen:   ";
                            print_r($array[0]);
                            echo ",   ";
                            print_r($array[1]);
                        } ?>
                    </label>


                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Naam licentie</th>
                        </tr>
                        <tr>
                            <th>Doelgroep</th>
                            <th>Hoofdgebruiker</th>
                        </tr>
                        <tr>
                            <th rowspan="2">Beschrijving</th>
                            <th>Licentiecode</th>
                        </tr>
                        <tr>
                            <th>Verleng uitleg</th>
                        </tr>
                        <tr>
                            <th>Vervaldatum</th>
                            <th>Installatie uitleg</th>
                        </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <form action='licenties.php' method='post' id="toevoegen">
                    <div class="row">
                        <div class="form-group">
                            <textarea class="form-control text-center" name="LNaam" id="" rows="1"
                                placeholder="Naam Licentie"></textarea>
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
                                <textarea class="form-control" name="LVerval" id="" rows="1"
                                    placeholder="Vervaldatum"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea class="form-control" name="LHGebr" id="" rows="1"
                                    placeholder="Hoofdgebruiker"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="LCode" id="" rows="2"
                                    placeholder="Licentiecode"></textarea>
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
                    <button type="submit" form="toevoegen" name="Toevoegen" value="Nieuw" class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>




</body>

</html>
