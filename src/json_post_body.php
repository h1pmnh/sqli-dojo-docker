<?php include_once('common/common.php'); do_header("JSON POST Attribute Injection (Body)", "APIs"); ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON input from the request body
    $jsonInput = file_get_contents('php://input');

    // Decode the JSON input into an associative array
    $data = json_decode($jsonInput, true);

    // Check if "id" attribute exists
    if (isset($data['id'])) {
        $id = dojo_filter_input($data['id']);

        $pdo = getConnection();
        if ($pdo !== null) {
            // Writing the code like this will prevent the SQL injection :)
            // $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = :id";
            // $statement = $pdo->prepare($query);
            // $statement->bindParam(':id', $id, PDO::PARAM_INT);
            // $statement->execute();

            $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = " . $id;
            $statement = execute_and_handle_error(function()use($pdo,$query){return $pdo->query($query);});

            echo "<h2>People Lookup Results</h2>";
            echo "<table>";
            echo "<tr><th>First Name</th><th>Last Name</th></tr>";

            if ($statement) {
                // Fetch and display the results
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . htmlspecialchars($row['FIRST_NAME']) . "</td><td>" . htmlspecialchars($row['LAST_NAME']) . "</td></tr>";
                }
            }

            echo "</table>";
        }
    } else {
        echo "<p>No 'message' attribute found in the JSON input.</p>";
    }
} else {
    echo "<p>This page expects a POST request with a JSON body containing an 'id' attribute.</p>";
}
?>

<?php include_once('common/footer.php'); ?>
</body></html>
