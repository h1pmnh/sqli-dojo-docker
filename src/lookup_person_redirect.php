<?php session_start(); include_once('common/common.php'); ?>
<?php
if (isset($_POST['id'])) {
    // this would ensure only an integer is passed
    // $id = intval($_GET['id']);
    require_once('common/common_filter.php');
    $id = dojo_filter_input($_POST['id']);
    $_SESSION['id'] = $id;
    header("Location: /lookup_person_redirect.php");
} elseif (isset($_SESSION['id'])) {
    do_header("POST parameter via session variable and redirect", "Traditional Forms");
    // after redirect
    $id = $_SESSION['id'];
    $pdo = getConnection();
    if ($pdo !== null) {
        // Writing the code like this will prevent the SQL injection :)
        // $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = :id";
        // $statement = $pdo->prepare($query);
        // $statement->bindParam(':id', $id, PDO::PARAM_INT);
        // $statement->execute();

        $query = "SELECT FIRST_NAME, LAST_NAME FROM PEOPLE WHERE id = " . $id;
        try {
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
        } catch (Throwable $th) {
            echo "<b>Error:</b> " . $th . "<br/>";
        }

    }
} else {
    do_header("POST parameter via session variable and redirect", "Traditional Forms");
    $id = "1";
}
?>
<form action="/lookup_person_redirect.php" method="POST">
    <label for="id">ID to Search</label>
    <input type=text name=id id=id size=10 value="<?php echo($id) ?>">
    <input type=submit value="Search">
</form>

<br/><p>Please note, the below SQLMap suggestion will not work for this page, you'll need to learn about the use of a <code>POST</code> request and the <code>-r</code> command!</p>

<?php include_once('common/footer.php'); ?>
</body>
</html>
