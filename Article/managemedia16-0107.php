<? 
/*
 * by DL to support Freeola Editor. 
 * 
 * /uploads/articles/ media library
 * Database stuff may or may not be used at this point.
 * 
 */

session_start(); 

if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {

function expandDirectories($base_dir) {
      $directories = array();
      foreach(scandir($base_dir) as $file) {
            if($file == '.' || $file == '..') continue;
            $dir = $base_dir.DIRECTORY_SEPARATOR.$file; 
            if(is_dir($dir)) {
               // $directories []= $dir;
                $directories[] = DIRECTORY_SEPARATOR.$file; // Modified to only show relative dirs
                $directories = array_merge($directories, expandDirectories($dir));
            }
      }
      return $directories;
}

$response = array();
	
// Image types.
$image_types = array(
                  "image/gif",
                  "image/jpeg",
                  "image/pjpeg",
                  "image/jpeg",
                  "image/pjpeg",
                  "image/png",
                  "image/x-png"
              );

// Filenames in the uploads folder.
$path = $_SERVER['DOCUMENT_ROOT'] . "/uploads";
//$fnames = scandir($path);
/*
//$fnames = array();
$path = realpath($path);
$objects = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator($path), 
	RecursiveIteratorIterator::SELF_FIRST,
	RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"	
);

foreach($objects as $name => $object) {
	if ($object->isDir()) {
		$dirs[] = $name;	
	}
}*/

$directories = expandDirectories($path);
$fnames = array();
foreach($directories as $dir) {
	$scan = scandir($path . $dir);
	foreach ($scan as $sdir) {
		$sdirfiles[] = $dir . "/" . $sdir;
	}
	$fnames = array_merge($fnames, $sdirfiles);
}

//print_r($fnames);
//die;

// Check if folder exists.
if ($fnames) {
    // Go through all the filenames in the folder.
    foreach ($fnames as $name) {
        // Filename must not be a folder.
        //if (!is_dir($name)) {
            // Check if file is an image.
            if (in_array(mime_content_type($path . $name), $image_types)) {
                // Add to the array of links.
                array_push($response, "/uploads" . $name);
            }
        //}
    }
}

// Folder does not exist, respond with a JSON to throw error.
else {
    $response = new StdClass;
    $response->error = "Images folder does not exist!";
}

$response = json_encode($response);

// Send response.
echo stripslashes($response);


} else {
    die("Must be logged in as admin to upload.");
}
?>
