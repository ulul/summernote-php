<?php 


$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);


if ($_FILES['file']['error']) {
    echo json_encode([
            'error' => true,
            'message' => 'an error encountered ' . $_FILES['file']['error'],
        ], JSON_PRETTY_PRINT);
    exit();
}

if(!getimagesize($_FILES['file']['tmp_name'])){
    echo json_encode([
            'error' => true,
            'message' => 'file must an image'
        ], JSON_PRETTY_PRINT);
    exit();
}

$name = md5(rand(100, 200));
$ext = explode('.', $_FILES['file']['name']);
$filename = $name . '.' . $ext[1];
$destination = 'img/' . $filename; 
$location = $_FILES["file"]["tmp_name"];
@move_uploaded_file($location, $destination);

echo json_encode([
        'error' => false,
        'url' => $base_url.'img/' . $filename,
    ], JSON_PRETTY_PRINT);

?>