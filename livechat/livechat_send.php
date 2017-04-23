<?php
session_start();      		// Is necessary since AJAX is loading this page in a separate instance.

if (isset($_GET['send'])) {
	
	if (isset($_SESSION["User_Id"]) and isset($_SESSION["Is_Login"])) { // User must be logged in, otherwise return error to client
		$user_id = $_SESSION["User_Id"]; // Note: this is where you can set privileges, or take away chat permissions.
		//$user_name = $_SESSION["User_Name"];
		$status = "Normal";
		$content = $_GET["message"];
			
		// Check content conditions; cannot be blank or null, and be longer than 1000 characters (just cut off)
		if ($content == "" or $content == null) die();
		if (strlen($content) > 1000) {
			$content = substr($content, 0, 1000);
		}
		// Should the content string be encoded in any way? Probably not needed, since it adds overhead processing. PDO should work fine.		
		
		include "../config.php";	// DB PDO config only
		
		// Input: Message to send into chat
		$stmt = $pdo->prepare("INSERT INTO livechat(user_id, content, datetime, status) VALUES (:user, :content, NOW(), :status)");
		$stmt->bindParam(":user", $user_id, PDO::PARAM_INT); 
		$stmt->bindParam(":content", $content); 
		//$stmt->bindParam(":user_name", $user_name);
		$stmt->bindParam(":status", $status); //TODO: Switch if needed. 
		$stmt->execute();	
		$lastInsertId = $pdo->lastInsertId();
		
		// Update stats
		$stmt = $pdo->prepare("UPDATE livechat_stat SET current_message_id = :current_message_id WHERE chat_id=1 ");
		$stmt->bindParam(":current_message_id", $lastInsertId); // Update this value for the world to see that you made a new message
		$stmt->execute();
	
		$pdo = null; 
		
	}	

	die();
}

?>