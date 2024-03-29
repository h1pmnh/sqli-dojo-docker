<?php include_once('common/common.php'); do_header("POST Multipart Parameter Injection", "Non-Traditional Forms"); ?>

    <form action="lookup_person_multi.php" method="post" enctype="multipart/form-data">
        <label for="ID">Enter ID:</label>
        <input type="text" name="id" id="id">
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contentType = $_SERVER['CONTENT_TYPE'];

        // Check if the content type is multipart/form-data
        if (strpos($contentType, 'multipart/form-data') !== false) {
            $formData = $_POST;

            $pdo = getConnection();

            if ($pdo !== null) {
                if (isset($formData['id'])) {
                    $id = dojo_filter_input($formData['id']);
                    $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = " . $id;
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
                } else {
                    echo "<p>No 'id' parameter found in the multipart form data.</p>";
                }
            }
        } else {
            echo "<p>Invalid content type. This page expects a POST request with 'multipart/form-data' encoding.</p>";
        }
    } else {
        echo "<p>This page expects a POST request with a 'id' parameter in the multipart form data.</p>";
    }
    ?>

<?php include_once('common/footer.php'); ?>
</body>
</html>
