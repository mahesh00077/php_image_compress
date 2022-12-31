
<?php

error_reporting(1);

//give your image folder
$directory = "original_img";
$images = glob($directory . "/*.*");

$destination_path='compressed_img/';
if (!file_exists($destination_path)) {
    mkdir($destination_path, 0777, true);
}

$cnt=1;
foreach($images as $image)
{
    $imgArr=explode('.',$image);
    $orgImgArr=explode('/',$image);
    // echo $orgImgArr[1];die;
    if($imgArr[1]=='JPG' || $imgArr[1]=='jpg' || $imgArr[1]=='png' || $imgArr[1]=='PNG'){
        $img_path = $image;
        $percent = 0.5;

        list($width, $height) = getimagesize($img_path);
        $newwidth = $width * $percent;
        $newheight = $height * $percent;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        // $source = imagecreatefromjpeg($img_path);
        $info = getimagesize($img_path);
        if ($info['mime'] == 'image/jpeg') $source = imagecreatefromjpeg($img_path);
        elseif ($info['mime'] == 'image/gif') $source = imagecreatefromgif($img_path);
        elseif ($info['mime'] == 'image/png') $source = imagecreatefrompng($img_path);

        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // Output
        $arr=explode('.', $orgImgArr[1]);
        imagejpeg($thumb, $destination_path.$arr[0].".jpg", 70);
         
        echo "Image uploaded successfully -> $cnt <br>";
        $cnt++;
    }
}
die('<br>done..');

?>


