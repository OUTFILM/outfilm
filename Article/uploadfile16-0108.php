<? 
/*
 * DL to support Freeola Editor. 
 * 
 * Simply uploads to /uploads/files/ folder but provides a link and media library
 * Database stuff may or may not be used at this point.
 * 
 */

session_start(); 

if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {

if (isset($_FILES["file"]["name"])) { // Should really be only for images at the moment...
	$allowedExts = array("txt", "pdf", "doc", "sub", "ass", "srt", "mkv", "avi", "ssa",
		"docx", "xsl", "png", "jpg", "jpeg", "ai", "zip", "rar", "7z", "ac3", "avs",
		"log", "vob", "idx", "d2v", "divx", "ifo", "nfo");
	$file = explode(".", $_FILES["file"]["name"]);
	$extension = end($file);
	
    // Do not use $_FILES["file"]["type"] as it can be easily forged.
    //$finfo = finfo_open(FILEINFO_MIME_TYPE);
    //$mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
	
	if (in_array($extension, $allowedExts)) {
        // Generate new random name.
        //$name = sha1(microtime()) . "." . $extension;
		
		// Nah, actually, lets just replace any spaces in the name and lower case it
		$name = str_replace(" ", "-", strtolower($_FILES["file"]["name"]));
	
		$upload_path = $_SERVER["DOCUMENT_ROOT"] . "/uploads/files/" . $name;
		move_uploaded_file($_FILES["file"]["tmp_name"], $upload_path);
		
		// Generate response
		$response = new StdClass;
		$response->link = "/uploads/files/" . $name;
		die(stripslashes(json_encode($response)));
	} 	
}

} else {
    die("Must be logged in as admin to upload.");
}

?>