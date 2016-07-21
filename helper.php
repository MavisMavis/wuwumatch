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


function timeago($datetime, $full = false) {
    date_default_timezone_set('Asia/Kuala_Lumpur');

    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}