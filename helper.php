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

function getMatches($mysqli, $breed_id, $dog_id, $gender)
{
    $opposite = ($gender == 'Male') ? 'Female' : 'Male';

    $q = $mysqli->query("SELECT d.*, u.name AS owner_name, u.id AS owner_id, b.name AS breed_name
                      FROM `dogs` AS d, `users` AS u, `breeds` AS b 
                      WHERE d.owner_id = u.id AND d.breed_id = b.id
                      AND d.gender = '$opposite' 
                      AND d.id != '$dog_id'
                      AND d.breed_id = '$breed_id'
                      ORDER BY datetime_added DESC ");

    $dogs = [];

    while($row = $q->fetch_array(MYSQLI_ASSOC)) {
        $dog_id = $row['id'];
        $row['dog_photos'] = [];
        $dog_photos_q = $mysqli->query("SELECT location FROM dog_photos WHERE dog_id = '$dog_id' LIMIT 1"); // only take 1

        while($photos_row = $dog_photos_q->fetch_array(MYSQLI_ASSOC)) {
            $row['dog_photos'][] = $photos_row['location'];
        }

        $dogs[] = $row;
    }


    return $dogs;
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