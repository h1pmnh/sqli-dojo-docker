<?php include_once('common/view_source.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Lookup Person (GET)</title>
    <?php include_once('common/head.php'); ?>
</head>
<body>
    <?php include_once('common/nav.php'); ?>
    <h1>Lookup Person (GET)</h1>

<?php
require_once('db.php');
require_once('common_filter.php');

if (isset($_GET['id'])) {
    // $id = intval($_GET['id']);
    $id = dojo_filter_input($_GET['id']);
    // split the input based on : character
    $arr = explode(':',$id);
    if(count($arr) == 3) {
        $id = $arr[1];

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

            if(isset($statement)) {
                // Fetch and display the results
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . htmlspecialchars($row['FIRST_NAME']) . "</td><td>" . htmlspecialchars($row['LAST_NAME']) . "</td></tr>";
                }
            }
            echo "</table>";
        }
    } else {
        echo "<p>Incorrect format of `id`` parameter</p>";
        echo "<p>This page expects a 'id' parameter of the format <code>foo:ID:bar</code> in the URL e.g. <code>foo:1:bar</code>.</p>";
    }
} else {
    echo "<p>This page expects a 'id' parameter of the format <code>foo:ID:bar</code> in the URL e.g. <code>foo:1:bar</code>.</p>";
}
?>

</body>
</html>