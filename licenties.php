<?php
require('action/dbconnection.php');
require('includes/beveiliging.php');

$huidigeDatum = date("Y/m/d");
$datumOver7Dagen = date('Y-m-d', strtotime($huidigeDatum. ' +7 days')). "<br>";
$binnenkortVerloopArray = array();
$aantalVerlopenLicenties = 0;
$licenties = $conn->query("SELECT vervaldatum, licentienaam  FROM licenties");
foreach ($licenties as $item) {
    if ($item[0] < $datumOver7Dagen) {
        if($item[0] == "0000-00-00"){

        }
        else {
            $aantalVerlopenLicenties++;
            array_push($binnenkortVerloopArray, $item[1]);
        }
    }
}

$binnenkortVerloopArrayLengte = count($binnenkortVerloopArray);

    session_start();
    if (empty($_SESSION['LicentieID'])){
        $licentieMin = $conn->query("SELECT MIN(licentieid) AS LowLicentie FROM licenties");
        $licentieMin = $licentieMin->fetch();
        $_SESSION['LicentieID'] = $licentieMin['LowLicentie'];
    }
    $licentie = $conn->query("SELECT * FROM licenties WHERE licentieid=".$_SESSION['LicentieID']." ");
    $licentieSel = $licentie->fetch();

?>

<html>
<title>Licentiebeheer - Licenties</title>
<?php include "includes/head.php"; ?>
<script>
    function zoekFunctie() {
        // Variabelen verklaren
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("zoekenInput");
        // toUpperCase om het niet hoofdlettergevoelig te maken
        filter = input.value.toUpperCase();
        table = document.getElementById("licentieTable");
        tr = table.getElementsByTagName("tr");
        // Door alle table rows loopen met for lus, en de rows niet laten zien welke niet aan de zoek query voldoen
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }</script>
<body>
    <?php include "includes/navbar.php"; ?>
    <script>$("#nav-home").addClass( "active" );</script>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-hover" id="licentieTable" style="width: 350px;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Licenties</th>
                        </tr>
                    </thead>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="text" class="form-control" onkeyup="zoekFunctie()" name="" id="zoekenInput" aria-describedby="helpId"
                               placeholder="Licenties zoeken..." />
                    </div>
                    <tbody style="cursor: pointer; overflow-y: auto; height: 650px; display: block; max-width: 350px; min-width: 350px;">
                        <?php
                            $licenties = $conn->query("SELECT * FROM licenties");
                            while($row = $licenties->fetch()) {
                                $licentieID = $row[0];
                                $licentieNummer = $row[1];
                                echo "
                                            <tr class='licentieTable'  id=" . $licentieID . ">
                                            <td style='max-width: 340px; min-width: 340px;'>" . $row[4] . "</form></td>
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
                    <button type="button" class="btn btn-info" id="hide2" style="margin: 10px">Bijwerken</button>

                    <form class="form-signin" id="verwijderLicentieForm" action="action/action.php?a=deletelicentie" method="post" style="margin: 5px">
                        <input type="button" class="btn btn-danger" style="margin: 5px" value="Verwijder licentie" name="delete_button" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" />
                    </form>
                    <?php
                        if($aantalVerlopenLicenties > 0) {
                    ?>
                        <div class="btn-group dropright">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="margin: 10px;">
                                Licenties die binnenkort verlopen
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <?php
                                    $i = 0;
                                    while ($i < $binnenkortVerloopArrayLengte) {
                                        echo "<button class='dropdown-item' type='button'>" . $binnenkortVerloopArray[$i] . "</button>";
                                        $i++;
                                    }

                                ?>

                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>

                <form action="action/action.php?a=edit" method='post' id="edit">
                    <table class="table table-bordered" id="licentieDisplay">
                        <thead>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <b> Naam licentie</b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['licentienaam'] ?> </text>
                                    <textarea class="form-control text-center LicentieEditField" name="LNaam" rows="1"
                                        required><?php echo $licentieSel['licentienaam'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b> Doelgroep </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['doelgroep'] ?> </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LDoelGroep"
                                        rows="1" ><?php echo $licentieSel['doelgroep'] ?></textarea>
                                </td>
                                <td>
                                    <b> Hoofdgebruiker </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['hoofdgebruiker'] ?> </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LHGebr" rows="1"
                                        ><?php echo $licentieSel['hoofdgebruiker'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan=2>
                                    <b> Beschrijving </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['licentiebeschrijving'] ?>
                                    </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LBeschr" rows="4"
                                        ><?php echo $licentieSel['licentiebeschrijving'] ?></textarea>
                                </td>
                                <td>
                                    <b> Licentiecode </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['licentienummer'] ?> </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LCode" rows="1"
                                        ><?php echo $licentieSel['licentienummer'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b> Verleng Uitleg </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['verlenguitleg'] ?> </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LVerleng" rows="1"
                                        ><?php echo $licentieSel['verlenguitleg'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b> Vervaldatum </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['vervaldatum'] ?> </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LVerval" rows="1"
                                        ><?php echo $licentieSel['vervaldatum'] ?></textarea>
                                </td>
                                <td>
                                    <b> Installatie Uitleg </b> <br>
                                    <text class="LicentieInfo"> <?php echo $licentieSel['installatieuitleg'] ?> </text>
                                    <textarea class="form-control text-left LicentieEditField" name="LInstall" rows="1"
                                        ><?php echo $licentieSel['installatieuitleg'] ?></textarea>
                                </td>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button type="submit" form="edit" name="Edit" value="Edit"
                        class="btn btn-primary LicentieEditField">Bijwerking Vaststellen</button>
                </form>


                <form action="action/action.php?a=toevoegen" method='post' id="toevoegen" >
                    <div class="row-">
                        <div class="form-group">
                            <textarea class="form-control text-center" name="LNaam" id="LicentieNaam" rows="1"
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
                                <textarea class="form-control" name="LCode" id="" rows="2" placeholder="Licentiecode"
                                    ></textarea>
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
                    <div class="row-">
                            <input type="submit" form="toevoegen" name="Toevoegen" value="Toevoegen" class="btn btn-block btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap modal voor het verwijderen van licentie -->

        <div class="modal fade" tabindex="-1" role="dialog" id="confirm-submit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Licentie verwijderen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Weet je zeker dat je <b><?php echo $licentieSel['licentienaam'] ?></b> wil verwijderen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="submit">Verwijderen</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                var hideBool = true;
                var hideBoolEdit = true;
                var toevoegen = $("#toevoegen");
                var licentieDisplay = $("#licentieDisplay");
                var LicentieInfo = $(".LicentieInfo");
                var LicentieEditField = $(".LicentieEditField");

				$(hideElements);
                $(hideElementsEdit);

                $("#hide").click(function () {
                    hideBool = !hideBool
                    $(hideElements);
                })

                function hideElements() {
                    if (hideBool == true) {
                        $(toevoegen).hide();
                        $(licentieDisplay).show();
                    }
                    else {
                        $(licentieDisplay).hide();
                        $(toevoegen).show();
                        $("#LicentieNaam").focus();
						
                        $(LicentieInfo).show();
                        $(LicentieEditField).hide();
                    }
                }


                $("#hide2").click(function () {
                    hideBoolEdit = !hideBoolEdit
                    $(hideElementsEdit);
                })

                function hideElementsEdit() {
                    if (hideBoolEdit == true) {
                        $(LicentieInfo).show();
                        $(LicentieEditField).hide();
                    }
                    else {
                        $(LicentieInfo).hide();
                        $(LicentieEditField).show();
                    }
                }

                $('#LVerval').tooltip();
            });

            $('#submit').click(function(){
                $('#verwijderLicentieForm').submit();
            });

        </script>
</body>

</html>
