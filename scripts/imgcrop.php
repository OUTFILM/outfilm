<?php
//$image = imagecreatefromjpeg($_GET['src']);
$image = imagecreatefromstring(file_get_contents($_GET['src']));
$filename = 'cropped_whatever.jpg';

$thumb_width = isset($_GET["w"]) ? $_GET["w"] : 200;
$thumb_height = isset($_GET["h"]) ? $_GET["h"] : 150;

$width = imagesx($image);
$height = imagesy($image);

$original_aspect = $width / $height;
$thumb_aspect = $thumb_width / $thumb_height;

if ( $original_aspect >= $thumb_aspect )
{
   // If image is wider than thumbnail (in aspect ratio sense)
   $new_height = $thumb_height;
   $new_width = $width / ($height / $thumb_height);
}
else
{
   // If the thumbnail is wider than the image
   $new_width = $thumb_width;
   $new_height = $height / ($width / $thumb_width);
}

$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

// Resize and crop
imagecopyresampled($thumb,
                   $image,
                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                   0, 0,
                   $new_width, $new_height,
                   $width, $height);

// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');		   
imagejpeg($thumb);
imagedestroy($im);

?>