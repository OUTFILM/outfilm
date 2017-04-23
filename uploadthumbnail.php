<? 
	session_start();
	include 'config.php';
    if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 10) { 
    // requires php5
    
    $img = $_POST['img'];
	$max_size = $_POST['c_size'];
	$c_option = $_POST['c_option'];
	uploadfullsize($img , $max_size, $c_option);
	
    } else {
        die("access deny!");
    }
	
	
    function uploadfullsize ($img , $max_size, $c_option) {
    	include 'config.php';
    	define('UPLOAD_DIR', 'uploads/');
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
	    // file path is user_id/pic_id.png
	    $file =UPLOAD_DIR.$_SESSION["User_Id"].'/'. $ttempis . '.png';
	    // upload the file
	    $success = file_put_contents($file, $data);
	    //if it is successed, it will work on thumbnail image
	    if ($success) {
	        //$file = str_replace(' ', '', $file);
	        // thumb path is user_id/same image_id_c.png       
	        $file_compress = UPLOAD_DIR.$_SESSION["User_Id"].'/'. $ttempis . '_c.png';
			// execute the next making thumbnail function  	
	    	$c_filename = compress_image($file, $file_compress, 95, $max_size);
			//$_SESSION['tem_path'] = $file_compress;
			if ($c_option == 1) {
				$query_ALL3 = "UPDATE users SET Portrait_Id = :Portrait_Id WHERE User_Id = :uid";
				$result_t = $pdo->prepare($query_ALL3);
			    $result_t->bindParam(':Portrait_Id', $ttempis);
			    $result_t->bindParam(':uid', $_SESSION["User_Id"]);
				$result_t->execute();
				echo $ttempis;
			}
			else 
			echo $file_compress;
	        
	    } else {
	    	echo "error";
	    }
    }

    // Insert into media db
	function compress_image($source_url, $destination_url, $quality, $max_size) {
		$final_width_of_image = $max_size;
		
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
