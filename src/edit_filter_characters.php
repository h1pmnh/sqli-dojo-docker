<!DOCTYPE html>
<html>
<head>
    <title>Filter Characters Management</title>
    <?php include_once('common/head.php'); ?>
</head>
<body>
    <?php include_once('common/nav.php'); ?>
    <h1>Filter Characters Management</h1>
    <script>
        function removeCharacter(e) {
            e.currentTarget.parentElement.parentElement.remove();
        }
        function addNewRow() {
            var tr = document.createElement("tr");
            tr.innerHTML = "<td><input type='text' name='characters[]' value=''></td><td><button onclick=removeCharacter(event)>Remove</button></td>";
            document.getElementById('t').appendChild(tr);
        }
    </script>
    <?php
    require_once('db.php'); // Include your database connection code

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['characters'])) {
            $newCharacters = $_POST['characters'];

            $pdo = getConnection();

            if ($pdo !== null) {
                // Clear existing data from FILTER_SETUP table
                $pdo->exec("TRUNCATE TABLE FILTER_SETUP");

                // Insert new characters
                $insertValues = [];
                foreach ($newCharacters as $character) {
                    $insertValues[] = $pdo->quote($character);
                }

                $insertQuery = "INSERT INTO FILTER_SETUP (FILTER_CHARACTER) VALUES (" . implode("), (", $insertValues) . ")";
                $pdo->exec($insertQuery);

                echo "<p>Filter characters updated successfully.</p>";
            }
        }
    }

    $pdo = getConnection();

    if ($pdo !== null) {
        $query = "SELECT FILTER_CHARACTER FROM FILTER_SETUP";
        $statement = $pdo->query($query);

        echo "<form method='post'>";
        echo "<table id=t>";
        echo "<tr><th>Filter Character</th></tr>";

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td><input type='text' name='characters[]' value='" . htmlspecialchars($row['FILTER_CHARACTER']) . "'></td><td><button type=button onclick=removeCharacter(event)>Remove</button></td></tr>";
        }

        echo "</table>";
        echo "<button type=button onclick=addNewRow()>Add New Row</button>";
        echo "<input type='submit' value='Save'>";
        echo "</form>";
    } else {
        echo "<p>Database connection error.</p>";
    }
    ?>

</body>
</html>
