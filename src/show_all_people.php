<?php include_once('common/common.php'); do_header("GET Parameter Injection in Order By Clause", "Traditional Forms"); ?>

<?php
$order_by = $_GET['order_by'] ?? 'FIRST_NAME';

// this would ensure only an integer is passed
// $id = intval($_GET['id']);
$id = dojo_filter_input($order_by);

$pdo = getConnection();
if ($pdo !== null) {
    $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE ORDER BY " . $order_by . " ASC LIMIT 20"; # just in case people have polluted the database with insert testing
    $statement = execute_and_handle_error(function()use($pdo,$query){return $pdo->query($query);});

    echo "<h2>People Lookup Results, Sorted by ".$order_by."</h2>";
    echo "<table>";
    echo "<tr><th>First Name</th><th>Last Name</th></tr>";

    if(isset($statement)) {
        // Fetch and display the results
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . htmlspecialchars($row['FIRST_NAME']) . "</td><td>" . htmlspecialchars($row['LAST_NAME']) . "</td></tr>";
        }
    }

    echo "</table>";

    echo <<<SORTBY
    Sort by:
    <a href="show_all_people.php?order_by=FIRST_NAME">First Name</a>
    <a href="show_all_people.php?order_by=LAST_NAME">Last Name</a>
    SORTBY;
}
?>

<?php include_once('common/footer.php'); ?>
</body>
</html>
