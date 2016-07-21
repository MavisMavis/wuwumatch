<?php
require_once  "connect.php";
include "helper.php";
session_start();

$dog_id = $mysqli->real_escape_string($_GET['id']); // ?id=

$q = $mysqli->query("SELECT owner_id FROM dogs WHERE id='$dog_id' LIMIT 1");
$dog = $q->fetch_array(MYSQLI_ASSOC);
if(!empty($dog)) {
    if ($dog['owner_id'] == $_SESSION['user_id']) {
        // owner is correct
        // delete this dog
        $q = $mysqli->query("DELETE FROM dogs WHERE id='$dog_id'");

        $_SESSION['deleteSuccess'] = true;
    }
} else {
    $_SESSION['deleteSuccess'] = false;
}

redirect('dog-list.php');
exit();