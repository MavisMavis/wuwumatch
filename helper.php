<?php


function redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

function getBreeds($mysqli)
{
    $q = $mysqli->query("SELECT * FROM breeds");

    $results = [];
    while ($row = $q->fetch_array(MYSQLI_ASSOC)) {
        $results[] = $row;
    }

    return $results;
}