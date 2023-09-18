<?php
require_once('db.php');

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

    $orig_input = $input;
    $filtered_input = str_replace($filterCharacters, '', $input);
    if($orig_input !== $filtered_input) {
        if(!isset($_REQUEST['silentfilter'])) {
            echo('<div class="alert alert-primary" role="alert">');
            echo("<strong>Input filtered!</strong><br/>");
            echo("Original Input: <code>".htmlspecialchars($input)."</code><br/>");
            echo("Filtered Input: <code>".htmlspecialchars($filtered_input)."</code><br/>");
            echo('</div>');
        }
    }
    // Replace filter characters with an empty string
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
