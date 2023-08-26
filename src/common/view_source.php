<?php
// we permit viewing of source code
if (isset($_GET['source'])) {
    $bt = debug_backtrace(); // to get the original file
    $src_file = $bt[0]['file'];
    echo "<html><head><title>View Source: $src_file</title>";
    include_once('head.php');
    echo '</head><body><a href=javascript:history.go(-1)>Go Back</a><br/>';
    highlight_file($src_file);
    die();
}
?>
