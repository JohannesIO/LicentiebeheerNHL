<?php
        require("dbconnection.php");
        require("../includes/beveiliging.php");

        $exporteerQuery = "SELECT licentieid, licentiecode, licentienaam, licentiebeschrijving, hoofdgebruiker, vervaldatum, doelgroep, installatieuitleg, verlenguitleg FROM licenties ORDER BY licentienaam ASC";
        $stmt = $conn->prepare($exporteerQuery);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $output = fopen("php://output", "w");
        fputcsv($output, array('licentieid', 'licentiecode', 'licentienaam', 'licentiebeschrijving', 'hoofdgebruiker', 'vervaldatum', 'doelgroep', 'installatieuitleg', 'verlenguitleg'));
        $result = $stmt->fetchAll();
        foreach ($result as $row)
        {
            fputcsv($output, $row);
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Licenties' . date('d.m.Y') . '.csv');
        fclose($output);