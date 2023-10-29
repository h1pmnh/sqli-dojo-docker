<?php include_once('common/common.php'); do_header("XML POST via Form Parameter", "Non-Traditional Forms"); ?>

    <p>This example shows a form parameter with XML format where the injection point is in the XML document.</p>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $xmlContent = $_REQUEST['xmlContent'];
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

    <form method="post">
        <label for="xmlContent">Enter XML content:</label><br>
        <textarea name="xmlContent" id="xmlContent" rows="5" cols="40">
<searchCriteria><id>1</id></searchCriteria>
        </textarea><br>
        <input type="submit" value="Submit">
    </form>

    <?php include_once('common/footer.php'); ?>
</body>
</html>
