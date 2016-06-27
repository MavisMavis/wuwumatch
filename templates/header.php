<?php
    require_once('connect.php'); // require mysql connection script once
?>
<head>
    <?php
        if (defined('TITLE'))
            echo TITLE;
        else
            echo 'WuWuMatch'
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="/css/style.css" type="text/css" rel="stylesheet"/>
</head>
