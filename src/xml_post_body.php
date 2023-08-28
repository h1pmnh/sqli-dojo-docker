<?php include_once('common/view_source.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>XML Input via API (POST Body)</title>
    <?php include_once('common/head.php'); ?>
</head>
<body>
<?php include_once('common/nav.php'); ?>
    <h1>XML Input via API (POST Body)</h1>

    <p>This example shows POST body containing an XML document</p>

    <?php
    require_once('common_filter.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $xmlContent = file_get_contents('php://input');
        $xml = simplexml_load_string($xmlContent);

        if ($xml !== false && isset($xml->id)) {
            $id = dojo_filter_input($xml->id);

            $pdo = getConnection();

            if ($pdo !== null) {
                $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = " . $id;
                $statement = execute_and_handle_error(function()use($pdo,$query){return $pdo->query($query);});

                echo "<h2>People Lookup Results</h2>";
                echo "<table>";
                echo "<tr><th>First Name</th><th>Last Name</th></tr>";

                if ($statement) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td>" . htmlspecialchars($row['FIRST_NAME']) . "</td><td>" . htmlspecialchars($row['LAST_NAME']) . "</td></tr>";
                    }
                }

                echo "</table>";
            }
        } else {
            echo "<p>Invalid or missing XML data.</p>";
        }
    }
    ?>

    <p>Please POST the following content to this page:</p>
    <p><code>
        <searchCriteria><id>{nnn}</id></searchCriteria>
    </code></p>

</body>
</html>
