<?php include_once('common/view_source.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>JSON API Demo</title>
    <?php include_once('common/head.php'); ?>
</head>
<body>
    <?php include_once('common/nav.php'); ?>
    <h1>JSON API Demo</h1>

<?php
require_once('common_filter.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON input from the request body
    $jsonInput = $_REQUEST['jsonContent'];

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
        echo "<p>No 'id' attribute found in the JSON input.</p>";
    }
} else {
    echo "<p>This page expects a POST request with a JSON body containing an 'id' attribute in the 'jsonContent' parameter.</p>";
}
?>


    <form method="post">
        <label for="jsonContent">Enter JSON content:</label><br>
        <textarea name="jsonContent" id="jsonContent" rows="5" cols="40">
            {"id":"1"}
        </textarea><br>
        <input type="submit" value="Submit">
    </form>


</body></html>
