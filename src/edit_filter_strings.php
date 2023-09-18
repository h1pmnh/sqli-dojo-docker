<?php include_once('common/view_source.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Filter Strings Management</title>
    <?php include_once('common/head.php'); ?>
</head>
<body>
    <?php include_once('common/nav.php'); ?>
    <h1>Filter String Management</h1>
    <p>Note: this is a naive filtering which is using a simple character and case match, intended to simulate a WAF. Real WAFs employ SQL parsing and smarter filtering. Perhaps someday someone will contribute something smarter to this project!</p>
    <script>
        function removeString(e) {
            e.currentTarget.parentElement.parentElement.remove();
        }
        function addNewRow() {
            var tr = document.createElement("tr");
            tr.innerHTML = "<td><input type='text' name='strings[]' value=''></td><td><button onclick=removeString(event)>Remove</button></td>";
            document.getElementById('t').appendChild(tr);
        }
    </script>
    <?php
    require_once('common/db.php'); // Include your database connection code

    if (isset($_REQUEST['strings'])) {
        $newstrings = $_REQUEST['strings'];

        $pdo = getConnection();

        if ($pdo !== null) {
            // Clear existing data from FILTER_PHRASE_SETUP table
            $pdo->exec("TRUNCATE TABLE FILTER_PHRASE_SETUP");

            if($newstrings) {
                // Insert new strings
                foreach ($newstrings as $string) {
                    if(!($string === '')) {
                        $insertValue = $pdo->quote($string);
                        // please don't try to sql inject this page :~)
                        $insertQuery = "INSERT INTO FILTER_PHRASE_SETUP (FILTER_PHRASE) VALUES (" . $insertValue . ")";
                        $pdo->exec($insertQuery);
                    }
                }
            }

            echo "<p>Filter strings updated successfully.</p>";
        }
    }

    $pdo = getConnection();

    if ($pdo !== null) {
        $query = "SELECT FILTER_PHRASE FROM FILTER_PHRASE_SETUP";
        $statement = $pdo->query($query);

        echo "<form method='post'>";
        echo "<table id=t>";
        echo "<tr><th>Filter String</th></tr>";

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td><input type='text' name='strings[]' value='" . htmlspecialchars($row['FILTER_PHRASE']) . "'></td><td><button type=button onclick=removeString(event)>Remove</button></td></tr>";
        }

        echo "</table>";
        echo "<button type=button onclick=addNewRow()>Add New Row</button>";
        echo "<input type='submit' value='Save'>";
        echo "</form>";
    } else {
        echo "<p>Database connection error.</p>";
    }

    echo "<h2>Filter Suggestions</h2>";
    echo "<a href='edit_filter_strings.php?strings[]='>None</a>: <code></code><br/>";
    echo "<a href='edit_filter_strings.php?strings[]=AND&strings[]=OR'>Hard</a>: <code>AND, OR</code><br/>";
    echo "<a href='edit_filter_strings.php?strings[]=AND&strings[]=OR&strings[]=SUBSTR&strings[]=IF'>Harder</a>: <code>AND, OR, SUBSTR, IF</code><br/>";
    echo "<br/>";
    echo "Other strings to try: <code>SELECT, FROM, WHERE</code>, etc. - challenge yourself!";

    ?>

    <?php include_once('common/footer.php'); ?>
</body>
</html>
