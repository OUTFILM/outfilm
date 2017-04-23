<?php
session_start();      	// Remove if already called previously in another script 
include "../config.php";	// DB PDO config only

if (isset($_GET['update']) and isset($_SESSION["livechat_last_message_id"])) { // Get the latest chat message -- must have session_id first!
	// Input: LAST chat message ID shown (if there are any >, only get the new ones)
	$lastMsg = $_SESSION["livechat_last_message_id"]; // Use session var to keep track of this for security.

	session_write_close();
	
	// Only check if there is a new message (will be incremented if there is)
	$query = "SELECT current_message_id FROM livechat_stat WHERE chat_id=1"; // Always chat_id=1 for livechat
	$stmt = $pdo->prepare($query);
	//$currentChatLine = file_get_contents("livechat_current_line.html"); // decided not to use... too many collisions
	
	$data = null; // our return data
	$timeout = 30; // timeout in seconds
	$now = time(); // start time
	
	// loop for $timeout seconds from $now until we get $data
	while((time() - $now) < $timeout) {
		$stmt->execute(); // Query will be executed multiple times until new result is found
		$result = $stmt->fetch();
		if ($result["current_message_id"] > $lastMsg) { // If we get 1 or more new messages 		   	
		   	$query = "SELECT * FROM livechat WHERE message_id > :message_id ORDER BY message_id ASC LIMIT 5";
		    $stmt = $pdo->prepare($query);
		    $stmt->bindParam(':message_id', $lastMsg); // IDs need to be sequential in order for this to work.
		   	$stmt->execute();
			if ($stmt->rowCount() > 0) {			
			    $stmt->bindColumn('user_id', $chat_user_id);
			    //$stmt->bindColumn('user_name', $chat_user_name);
				$stmt->bindColumn('content', $chat_content);
				$stmt->bindColumn('message_id', $lastMsg);
				$stmt->bindColumn('datetime', $datetime);
			    $data = array();
			    while ($stmt->fetch()) { // Build JSON array 
					$sql = "SELECT Portrait_Id,User_Name FROM users WHERE User_Id=:user_id";
					$stmt_users = $pdo->prepare($sql);
					$stmt_users->bindParam(':user_id', $chat_user_id);
					$stmt_users->execute();
					$stmt_users->bindColumn('Portrait_Id', $chat_avatar);
					$stmt_users->bindColumn('User_Name', $chat_user_name);
					$stmt_users->fetch();
					
					// Get proper datetime  ISO 8601
					$dt = new DateTime($datetime);
					
					$data[] = array(
						"user_id" => $chat_user_id, 
						"user_name" => htmlentities($chat_user_name, ENT_QUOTES),
						"avatar" => $chat_avatar,
						"datetime" => $dt->format('c'),
						"content" => preg_replace( "/\r|\n/", "", nl2br(htmlentities($chat_content, ENT_QUOTES)))						
					); 	
					session_start();
					$_SESSION["livechat_last_message_id"] = $lastMsg; // Reset Last msg - Use session var for security.	
					session_write_close();	  
			    }
				$pdo = null; // Remove connection to MySQL DB STAT! 
				break; // Escape from the while loop -- we have $data now.					
			}			
		}
	
	    // wait 2 sec to check for new $data
	    usleep(20000);
	}
	
	// if there is no $data, tell the client to re-request (arbitrary status message)
	if (empty($data)) $data = array('status'=>'0');
	
	// send $data response to client
	echo json_encode($data);	
	die();
}
?>