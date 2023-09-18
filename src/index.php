<?php include_once('common/view_source.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>@pmnh's SQL Injection Dojo</title>
    <?php include_once('common/head.php'); ?>
</head>
<body>
    <?php include_once('common/nav.php'); ?>
    <h1>Welcome to the SQL Injection Dojo!</h1>
    <p>The purpose of this site is to provide you a variety of common SQL injection scenarios with the option to configure a server-side filter that allows you to test your skills with SQL injection including with character filtering in place. The purpose of these tests is not to be difficult, but to provide you the opportunity to practice!</p>
    <p>You have the option to adjust the filter characters globally if you wish, or remove them altogether.</p>
    <h1>How to Use</h1>
    <p>We recommend trying the challenges either manually or using your favorite automated tool. Once you've mastered them with the default filter settings, try adding additional character filters such as <code>,()</code> which will dramatically increase the difficulty!</p>
    <p>Also, we recommend trying different techniques, especially by hand. For example, you can easily inject a boolean query, what about the use of a <code>UNION</code>? What about a time-based query? Challenge yourself to try new techniques!</p>
    <h1>Feedback?</h1>
    <p>Please feel free to contact me via <a href="https://www.pmnh.site">My Site</a> (Twitter, GitHub, etc) if you have any feedback or suggestions!</p>

    <?php include_once('common/footer.php'); ?>
</body>
</html>
