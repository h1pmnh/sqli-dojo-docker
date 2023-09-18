<?php include_once('common/view_source.php'); ?>
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
            tr.innerHTML = "<td><input type='text' name='characters[]' value='' maxlength='1' size=1></td><td><button onclick=removeCharacter(event)>Remove</button></td>";
            document.getElementById('t').appendChild(tr);
        }
    </script>
    <?php
    require_once('common/db.php'); // Include your database connection code

    if (isset($_REQUEST['characters'])) {
        $newCharacters = $_REQUEST['characters'];

        $pdo = getConnection();

        if ($pdo !== null) {
            // Clear existing data from FILTER_SETUP table
            $pdo->exec("TRUNCATE TABLE FILTER_SETUP");

            if($newCharacters) {
                // Insert new characters
                $insertValues = [];
                foreach ($newCharacters as $character) {
                    $insertValues[] = $pdo->quote($character);
                }

                // please don't try to sql inject this page :~)
                $insertQuery = "INSERT INTO FILTER_SETUP (FILTER_CHARACTER) VALUES (" . implode("), (", $insertValues) . ")";
                $pdo->exec($insertQuery);
            }

            echo "<p>Filter characters updated successfully.</p>";
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
            echo "<tr><td><input type='text' name='characters[]' value='" . htmlspecialchars($row['FILTER_CHARACTER']) . "' maxlength='1' size=1></td><td><button type=button onclick=removeCharacter(event)>Remove</button></td></tr>";
        }

        echo "</table>";
        echo "<button type=button onclick=addNewRow()>Add New Row</button>";
        echo "<input type='submit' value='Save'>";
        echo "</form>";
    } else {
        echo "<p>Database connection error.</p>";
    }

    echo "<h2>Filter Suggestions</h2>";
    echo "<a href='edit_filter_characters.php?characters[]='>None</a>: <code></code><br/>";
    echo "<a href='edit_filter_characters.php?characters[]=%3c&characters[]=%3e'>Default</a>: <code>&lt;&gt;</code><br/>";
    echo "<a href='edit_filter_characters.php?characters[]=%3c&characters[]=%3e&characters[]=%20&characters[]=%3d&characters[]=%2b&characters[]=%7c'>Hard</a>: Default + <code>=|+(space)</code><br/>";
    echo "<a href='edit_filter_characters.php?characters[]=%3c&characters[]=%3e&characters[]=%20&characters[]=%3d&characters[]=%2b&characters[]=%7c&characters[]=(&characters[]=)&characters[]=%27&characters[]=%22'>Very Hard</a>: Hard + <code>()'&quot;</code><br/>";
    echo "<br/>";
    echo "Other Characters to try: <code>,.</code> - challenge yourself!";

    ?>

    <?php include_once('common/footer.php'); ?>

</body>
</html>
