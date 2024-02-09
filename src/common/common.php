<?php ## Used to draw the top portion of every page ?>
<?php
function do_header($page_title, $page_category) {
    include_once('common/view_source.php');
    echo <<<END
    <!DOCTYPE html>
    <html>
    <head>
        <title>{$page_title}</title>
    END;
    include_once('common/head.php');
    echo <<<END
    </head>
    <body class="mx-0">
    END;
    include_once('common/nav.php');
    echo("<div class=\"mx-2\"><h1>{$page_category} &gt; {$page_title}</h1>");

    require_once('common/db.php');
    require_once('common/common_filter.php');
}

?>
