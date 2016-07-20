<?php

header('Content-type: application/json');

$images_arr = array();
foreach($_FILES['images']['name'] as $key=>$val){

    // for security reasons, hash the file name tp prevent backdoor uploads
    // and to allow images to be unique
    $file = $_FILES['images']['name'][$key];
    $ext = pathinfo($file, PATHINFO_EXTENSION); // jpg
    $filename = explode('.', $file); // [0] => image [1] => jpg
    $new_filename = md5($filename[0]).'.'.$ext;

    // move from temporary $_FILES to uploads/ directory
    if(move_uploaded_file($_FILES['images']['tmp_name'][$key],'uploads/'.$new_filename)){
        $images_arr[] = $new_filename;
    }
}

echo json_encode($images_arr);



