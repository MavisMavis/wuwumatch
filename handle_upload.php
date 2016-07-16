<?php

if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    // for security reasons, need to hash the file name to prevent backdoor uploads
    $file = $_FILES['file']['name']; // image.jpg
    $ext = pathinfo($file, PATHINFO_EXTENSION); // jpg
    $filename = explode('.', $file); // [0] => image [1] => jpg
    $new_filename = md5($filename[0]).'.'.$ext;

    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $new_filename);
}
