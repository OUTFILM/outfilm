<?php
//die("d");
if (!isset($_GET["user"]) or !isset($_GET["src"])) exit;

// Get user id and source image
$user_id = $_GET["user"];
$src = $_GET["src"];

// Get path
$imgpath = $_SERVER["DOCUMENT_ROOT"]."/uploads/".$user_id."/".$src;
if (is_file($imgpath)) {
	$image = imagecreatefromstring(file_get_contents($imgpath));	
} else {
	$default = $_SERVER["DOCUMENT_ROOT"]."/uploads/default_portrait.png";
	$image = imagecreatefromstring(file_get_contents($default));	
}

// Set the content type header - in this case image/png
header('Content-Type: image/png');		   
imagepng($image);
//imagedestroy($image); // Frees image from memory

?>