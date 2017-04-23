<?php

if (!empty($_FILES)) {
		
	include "../scripts/hashids.php-1.0.5/lib/Hashids/HashGenerator.php";	
	include "../scripts/hashids.php-1.0.5/lib/Hashids/Hashids.php";
	$hashids = new Hashids\Hashids('Q', 8);
	$id = $hashids->encode(1337, 5);
		 
	$ds          = DIRECTORY_SEPARATOR;  
	$storeFolder = 'uploads';       
    $tempFile = $_FILES['file']['tmp_name'];      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;      
    //$targetFile =  $targetPath. $_FILES['file']['name'];   
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $targetFile = $targetPath . $id . "-" . sha1_file($tempFile) . "." . $ext;

    move_uploaded_file($tempFile,$targetFile); 
} 

?> 

<html>
<head>   
<link href="/scripts/dropzone.css" type="text/css" rel="stylesheet" />
<script src="/scripts/dropzone.js"></script> 
</head>
 
<body>

<form action="upload_img.php" class="dropzone"></form>
   
</body>
 
</html>