<?php
// we permit viewing of source code
if (isset($_GET['source'])) {
    $bt = debug_backtrace(); // to get the original file
    $src_file = $bt[1]['file'];
    echo "<html><head><title>View Source: $src_file</title>";
    include_once('head.php');
    echo <<<END
    <script>
    window.addEventListener('DOMContentLoaded', () => {
        var stylesheet = document.createElement("link");
        stylesheet['rel']="stylesheet";
        if(isDark()) {
            stylesheet['href']="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css";
        } else {
            stylesheet['href']="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-light.min.css";
        }
        document.head.appendChild(stylesheet);
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    END;
    echo '</head><body>';
    echo "<h1>View Source: $src_file</h1>";
    $src = file_get_contents($src_file);
    echo "<pre><code class='language-php'>" . htmlspecialchars($src) . "</code></pre>";
    echo "<script>hljs.highlightAll();</script>    ";
    // sorry, PHP syntax highlighting doesn't work with dark mode
    die();
}
?>
