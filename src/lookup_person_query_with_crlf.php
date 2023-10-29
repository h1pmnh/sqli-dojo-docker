<?php include_once('common/common.php'); do_header("GET Parameter Injection with CR/LF in Query", "Traditional Forms"); ?>

<?php
if (isset($_GET['id'])) {
    // this would ensure only an integer is passed
    // $id = intval($_GET['id']);
    $id = dojo_filter_input($_GET['id']);

    $pdo = getConnection();
    if ($pdo !== null) {
        // Writing the code like this will prevent the SQL injection :)
        // $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = :id";
        // $statement = $pdo->prepare($query);
        // $statement->bindParam(':id', $id, PDO::PARAM_INT);
        // $statement->execute();

        // apparently in mysql \r\n does not stop the -- comment from ignoring it?
        $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE (id = " . $id . ") \r\norder by LAST_NAME";
        $statement = execute_and_handle_error(function()use($pdo,$query){return $pdo->query($query);});

        echo "<h2>People Lookup Results</h2>";
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th></tr>";

        if(isset($statement)) {
            // Fetch and display the results
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['FIRST_NAME']) . "</td><td>" . htmlspecialchars($row['LAST_NAME']) . "</td></tr>";
            }
        }

        echo "</table>";
    }
} else {
    echo "<p>This page expects a 'id' parameter in the URL.</p>";
}
?>

<?php include_once('common/footer.php'); ?>
</body>
</html>
