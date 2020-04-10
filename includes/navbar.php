<?php
    echo "
    <nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
        <a class='navbar-brand' href='licenties.php'>Licentiebeheer.</a>
        <div class='collapse navbar-collapse' id='navbarText'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'>
                    <a class='nav-link' href='licenties.php' id='nav-home'>Home.</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='accountbeheer.php' id='nav-acc'>Account beheren.</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='action/action.php?a=logout'>Logout.</a>
                </li>
            </ul>
            <span class='navbar-text' style='cursor: default;'>
                    Welkom <b>" . $userData['gebruikersnaam'] . "</b>.
                </span>
        </div>

    </nav>
    ";
?>