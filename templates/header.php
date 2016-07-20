<?php
require_once('connect.php'); // require mysql connection script once
require_once('helper.php'); // for helper functions

session_start();
?>
<head>
    <title>
    <?php
    if (defined('TITLE'))
        echo TITLE;
    else
        echo 'WuWuMatch'
    ?>
     </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet"/>

</head>
