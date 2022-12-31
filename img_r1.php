
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
$source = imagecreatefromjpeg($img_path);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
imagejpeg($thumb, $destination_path.$org_img, 75);

$filename = compress_image($destination_path.$org_img, $destination_path.$org_img, 75);

function compress_image($source_url, $destination_url, $quality)
{
    $info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);


    imagejpeg($image, $destination_url, $quality);
    
    echo "Image uploaded successfully.";
} 

/*function convert_filesize($bytes,$decimals=2){ 
	$size=array('B','KB','MB','GB','TB','PB','EB','ZB','YB'); 
	$factor=floor((strlen($bytes)-1)/3); 
	return sprintf("%.{$decimals}f",$bytes/pow(1024,$factor)).@$size[$factor]; 
}*/

?>


