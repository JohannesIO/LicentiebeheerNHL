<?php
    require('action/dbconnection.php');
    require('includes/beveiliging.php');
?>
<html>
    <title>Licentiebeheer - Accountbeheer</title>
        <?php include "includes/head.php"; ?>
    <body>
    <?php include "includes/navbar.php"; ?>
    <script>$("#nav-acc").addClass( "active" );</script>
    <br />
        <div class="container">
            <div class="col-sm">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="1" class="text-center"><b>Gebruikersnaam</b></th>
                        <th colspan="1" class="text-center"><b>E-mail</b></th>
                        <th colspan="1" class="text-center"><b>Wachtwoord</b></th>
                        <th colspan="1" class="text-center"><b>Adminrechten</b></th>
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
                            <tr id="accountbeheer" style="font-weight: normal;">
                                <th colspan="1" class="text-center"><?php echo $gebruiker[2] ?></th>
                                <th colspan="1" class="text-center"><?php echo $gebruiker[1] ?></th>
                                <th colspan="1" class="text-center blur" id="tableWachtwoord"><?php echo $gebruiker[3] ?></th>
                                <th colspan="1" class="text-center"><?php echo $Admin ?></th>
                            </tr>

                        <?php
                        }
                        ?>

                    </thead>
                </table>
                <a href="licenties.php"><button class="accountbeheerTerug">terug</button></a>
                <button class="accountbeheerBijwerken">bijwerken?</button>
                <button class="accountbeheerTerug" style="width: auto">Nieuwe beheerder toevoegen</button>
            </div>
        </div>
    <script>
            $(document).ready(function(){
                    $('#tableWachtwoord').hover(function() {
                        $(this).removeClass('blur');
                    }).mouseout(function(){
                        $(this).addClass('blur');
                    });
            });
    </script>
    </body>
</html>
