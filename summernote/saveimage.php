<?php 
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        
        $name = md5(rand(100, 200));
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
        $destination = 'img/' . $filename; //change this directory
        $location = $_FILES["file"]["tmp_name"];
        @move_uploaded_file($location, $destination);
        echo $base_url.'img/' . $filename;//change this URL
    }
    else
    {
      echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}
?>