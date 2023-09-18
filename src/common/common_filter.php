<?php
require_once('db.php');

function getFilterStrings() {
    $pdo = getConnection();

    if ($pdo !== null) {
        $query = "SELECT FILTER_PHRASE FROM FILTER_PHRASE_SETUP";
        $statement = $pdo->query($query);
        $strings = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $strings[] = $row['FILTER_PHRASE'];
        }

        return $strings;
    }

    return [];
}

function getFilterCharacters() {
    $pdo = getConnection();

    if ($pdo !== null) {
        $query = "SELECT FILTER_CHARACTER FROM FILTER_SETUP";
        $statement = $pdo->query($query);
        $characters = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $characters[] = $row['FILTER_CHARACTER'];
        }

        return $characters;
    }

    return [];
}

function dojo_filter_input($input) {
    $filterCharacters = getFilterCharacters();
    $filterStrings= getFilterStrings();

    $orig_input = $input;
    $filtered_input = str_replace($filterCharacters, '', $input);
    // Replace filter characters with an empty string

    // for now we will just remove phrases in the same case as they exist, this will simulate the behavior
    // for sqlmap and similar automated tools but of course is easier to bypass than a real WAF, which will syntactically
    // parse the statement and filter based on that, maybe someday...
    foreach($filterStrings as $phrase) {
        $filtered_input = str_replace($phrase, '', $filtered_input);
    }
    if($orig_input !== $filtered_input) {
        if(!isset($_REQUEST['silentfilter'])) {
            echo('<div class="alert alert-primary" role="alert">');
            echo("<strong>Input filtered!</strong><br/>");
            echo("Original Input: <code>".htmlspecialchars($input)."</code><br/>");
            echo("Filtered Input: <code>".htmlspecialchars($filtered_input)."</code><br/>");
            echo('</div>');
        }
    }

    return $filtered_input;
}

function execute_and_handle_error($fn) {
    try {
        return $fn();
    } catch (Exception $exc) {
        // if the ERROR parameter is set
        if(isset($_REQUEST['error'])) {
            if($_REQUEST['error'] == 'silent') {
                // simply stop
                die();
            }
        } else {
            throw $exc;
        }
    }
}
?>
