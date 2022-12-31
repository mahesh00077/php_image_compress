
<?php

error_reporting(1);

$org_img='DSC03259.jpg';

$current_path='img/';
$destination_path='compressed_img/';
if (!file_exists($destination_path)) {
    mkdir($destination_path, 0777, true);
}


$img_path = $current_path.$org_img;
$percent = 0.5;

list($width, $height) = getimagesize($img_path);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
// $source = imagecreatefromjpeg($img_path);
$info = getimagesize($img_path);
if ($info['mime'] == 'image/jpeg') $source = imagecreatefromjpeg($img_path);
elseif ($info['mime'] == 'image/gif') $source = imagecreatefromgif($img_path);
elseif ($info['mime'] == 'image/png') $source = imagecreatefrompng($img_path);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
$arr=explode('.', $org_img);
imagejpeg($thumb, $destination_path.$arr[0].".jpg", 50);
 
echo "Image uploaded successfully.";

?>


