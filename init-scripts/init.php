<?php
require_once('/var/www/html/db.php');

$filterCharacters = $_ENV['FILTER_CHARACTERS'];

$pdo = getConnection();

if ($pdo !== null) {
    $pdo->exec("TRUNCATE TABLE FILTER_SETUP");

    $insertValues = [];
    foreach (str_split($filterCharacters) as $character) {
        $insertValues[] = $pdo->quote($character);
    }

    $insertQuery = "INSERT INTO FILTER_SETUP (FILTER_CHARACTER) VALUES (" . implode("), (", $insertValues) . ")";
    $pdo->exec($insertQuery);

    echo "Filter characters inserted into FILTER_SETUP table.\n";
} else {
    echo "Database connection error.\n";
}
?>
