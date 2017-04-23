<?php
session_start(); // Remove if already called previously in another script 
include $_SERVER["DOCUMENT_ROOT"]."/config.php"; // DB PDO config only

if (isset($_GET["catalog_id"])) {
	//$catid = $_SESSION["catalog_id"]; // Use session var to keep track of this for security.
	$catid = $_GET["catalog_id"];
	
	$data = null; // our return data

	if ($catid == 0) { // Get Top 10 or so comments only; article 0 does not exist (or at least it shouldn't!)
		$query = "SELECT * FROM comments,catalog WHERE comments.Catalog_Id = catalog.Catalog_Id ORDER BY Comment_Id DESC LIMIT 7";
	} else {
		$query = "SELECT * FROM comments WHERE Catalog_Id=:catid ORDER BY Comment_Id ASC";		
	}
	
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':catid', $catid); // IDs need to be sequential in order for this to work.	   	
	$stmt->execute();
	if ($stmt->rowCount() > 0) {			
	    $stmt->bindColumn('User_Id', $user_id);
		$stmt->bindColumn('Content', $content);
		$stmt->bindColumn('Comment_Id', $comment_id);
		$stmt->bindColumn('Date_Time', $datetime);
		$stmt->bindColumn('Catalog_Id', $Catalog_Id);
		if ($catid == 0) $stmt->bindColumn('Headline', $Headline);
	    $data = array();
	    while ($stmt->fetch()) { // Build JSON array 
			$sql = "SELECT Portrait_Id,User_Name FROM users WHERE User_Id=:user_id";
			$stmt_users = $pdo->prepare($sql);
			$stmt_users->bindParam(':user_id', $user_id);
			$stmt_users->execute();
			$stmt_users->bindColumn('Portrait_Id', $avatar);
			$stmt_users->bindColumn('User_Name', $user_name);
			$stmt_users->fetch();
			
			// Get proper datetime  ISO 8601
			$dt = new DateTime($datetime);
			
						
			
			$data[] = array(
				"user_id" => $user_id, 
				"user_name" => htmlentities($user_name, ENT_QUOTES),
				"avatar" => $avatar,
				"datetime" => $dt->format('c'),
				"content" => preg_replace( "/\r|\n/", "", nl2br(htmlentities($content, ENT_QUOTES))),
				"article_id" => $Catalog_Id,
				"article_title" => $Headline	
			); 	
			//session_start();
			//$_SESSION["livechat_last_message_id"] = $lastMsg; // Reset Last msg - Use session var for security.	
			//session_write_close();	  
	    }
		$pdo = null; // Remove connection to MySQL DB STAT! 
		//break; // Escape from the while loop -- we have $data now.					
	}			
		
	
	    // wait 2 sec to check for new $data
	    //usleep(20000);

	
	// if there is no $data, tell the client to re-request (arbitrary status message)
	if (empty($data)) $data = array('status'=>'0');
	
	// send $data response to client
	echo json_encode($data);	
	die();
}
?>