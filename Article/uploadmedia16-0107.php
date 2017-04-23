<? 
/*
 * Edited again by DL to support Freeola Editor. 
 * 
 * Simply uploads to /uploads/articles/ folder but provides a link and media library
 * Database stuff may or may not be used at this point.
 * 
 */

session_start(); 

if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {

if (isset($_FILES["file"]["name"])) { // Should really be only for images at the moment...
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$file = explode(".", $_FILES["file"]["name"]);
	$extension = end($file);
	
	// An image check is being done in the editor but it is best to
    // check that again on the server side.
    // Do not use $_FILES["file"]["type"] as it can be easily forged.
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
	
	if ((($mime == "image/gif")
    || ($mime == "image/jpeg")
    || ($mime == "image/pjpeg")
    || ($mime == "image/x-png")
    || ($mime == "image/png"))
    && in_array($extension, $allowedExts)) {
        // Generate new random name.
        $name = sha1(microtime()) . "." . $extension;
	
		$upload_path = $_SERVER["DOCUMENT_ROOT"] . "/uploads/articles/" . $name;
		move_uploaded_file($_FILES["file"]["tmp_name"], $upload_path);
		
		// Generate response
		$response = new StdClass;
		$response->link = "/uploads/articles/" . $name;
		die(stripslashes(json_encode($response)));
	} 	
}

if (isset($_POST["img"])) { // Process upload, but only if we're admin first

	// requires php5
	define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/img/article');

    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
        //if the account's folder not exsist, then creat as uploads/$id/
    if (is_dir("uploads/".$_POST["cid"])) {       
        //console.log("uploads/".$_SESSION["User_Id"]."exsists!");
    } else {
        mkdir('uploads/'.$_POST["cid"], 0777, true);
        //console.log("uploads/".$_SESSION["User_Id"]."made a new one!"); 
    }
    $ttempis = uniqid();
    $file = UPLOAD_DIR .$_POST["cid"].'/'. $ttempis . '.png';

    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.' . $_POST["img"];

    $mediaTitle = $_POST["title"];
    $mediaType = "image";
    $mediaExtension = "png";
    $mediaSize = filesize($file);
    $uploadUser = $_SESSION["User_Id"];
    $catalog_id = $_POST["cid"];
    $hashlink = $ttempis;
 
 	// Insert into media database...
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    
    $sql = "INSERT INTO media SET 
                    Title = :title,
                    Hashlink = :hashlink,
                    Type = :type,
                    Extension = :extension,
                    Size_Img = :size,
                    User_Id = :user_id,
                    Catalog_Id = :cid  ";
    
    $result_t = $pdo->prepare($sql);
    $result_t->bindParam(':title', $mediaTitle);
    $result_t->bindParam(':hashlink', $hashlink);
    $result_t->bindParam(':type', $mediaType);
    $result_t->bindParam(':extension', $mediaExtension);
    $result_t->bindParam(':size', $mediaSize);
    $result_t->bindParam(':user_id', $uploadUser);
    $result_t->bindParam(':cid', $catalog_id);
    $result_t->execute();
    
    die("Success");
    
}

} else {
    die("Must be logged in as admin to upload.");
} ?>