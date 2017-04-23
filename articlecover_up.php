
<? 
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    session_start();
    if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 10) { 
    // requires php5
    //define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads/');
    define('UPLOAD_DIR', 'uploads/');
    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
        //if the account's folder not exsist, then creat as uploads/$id/
    if (is_dir("uploads/".$_SESSION["User_Id"])) {       
        //console.log("uploads/".$_SESSION["User_Id"]."exsists!");
    } else {
        mkdir('uploads/'.$_SESSION["User_Id"], 0777, true);
        //console.log("uploads/".$_SESSION["User_Id"]."made a new one!"); 
    }
    $ttempis = uniqid();
    $file =UPLOAD_DIR.$_SESSION["User_Id"].'/'. $ttempis . '.png';
    $_SESSION['tem_path'] = $file;
    $success = file_put_contents($file, $data);
    if ($success) {
        //$file = str_replace(' ', '', $file);       
        $file_compress = UPLOAD_DIR.$_SESSION["User_Id"].'/'. $ttempis . '_c.png'; 	
		$c_filename = compress_image($file, $file_compress, 75);
		$_SESSION['tem_path_cc'] = $c_filename;
		echo $file;
        
    } else {
    	echo "error";
    }
    } else {
        die("access deny");
    }
    
    // Insert into media db
	function compress_image($source_url, $destination_url, $quality) {
		$final_width_of_image = 350;
		
		$info = getimagesize($source_url); //get info from original image
		 
		if ($info['mime'] == 'image/jpeg') 
		 	$image = imagecreatefromjpeg($source_url); 
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source_url); 
		elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
		 
	    $ox = imagesx($image);
		$oy = imagesy($image);
		 
		$nx = $final_width_of_image;
		$ny = floor($oy * ($final_width_of_image / $ox));
		 
		$nm = imagecreatetruecolor($nx, $ny);
		 
		imagecopyresized($nm, $image, 0,0,0,0,$nx,$ny,$ox,$oy);
		  
		imagejpeg($nm, $destination_url, $quality); 
		return $destination_url; 
	}
?>
