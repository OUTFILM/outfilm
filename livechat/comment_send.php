<?php
session_start();      		// Is necessary since AJAX is loading this page in a separate instance.

if (isset($_GET['send'])) {
	
	if (isset($_SESSION["User_Id"]) and isset($_SESSION["Is_Login"])) { // User must be logged in, otherwise return error to client
		$user_id = $_SESSION["User_Id"]; // Note: this is where you can set privileges, or take away chat permissions.
		$status = "Normal";
		$content = $_GET["message"];
		$commentNumber = $_GET["commentNumber"]; // Must be a number
		$catid = $_GET["catid"]; // Must be valid; maybe use session to track this instead!
		
		// Check content conditions; cannot be blank or null, and be longer than 2000 characters (just cut off)
		if ($content == "" or $content == null) die();
		if (mb_strlen($content, "UTF-8") > 2000) {
			$content = mb_substr($content, 0, 2000, "UTF-8");
		}
		// Should the content string be encoded in any way? Probably not needed, since it adds overhead processing. PDO should work fine.		
		
		include $_SERVER["DOCUMENT_ROOT"]."/config.php";	// DB PDO config only
		
		// Input: Message to send into chat
		$stmt = $pdo->prepare("INSERT INTO comments SET User_Id=:user_id, Catalog_Id=:catalog_id, Content=:content, Date_Time=now()");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT); 
		$stmt->bindParam(":content", $content); 
		$stmt->bindParam(":catalog_id", $catid);
		$stmt->execute();	
		$lastInsertId = $pdo->lastInsertId();
		echo $lastInsertId;
		
		// Update stats
		//$stmt = $pdo->prepare("UPDATE livechat_stat SET current_message_id = :current_message_id WHERE chat_id=1 ");
		//$stmt->bindParam(":current_message_id", $lastInsertId); // Update this value for the world to see that you made a new message
		//$stmt->execute();
	    
        //From Twitter API (Doesn't include Han chars): (^|[^a-z0-9_])[@＠]([a-z0-9_]{1,20})([@＠\xC0-\xD6\xD8-\xF6\xF8-\xFF]?)
        //From personal research: @((\s*\w+){1,2})\b(?:EFG|$)
      	// Final: (^|[^@\w])@(\w{1,15})\b From: http://stackoverflow.com/questions/8650007/regular-expression-for-twitter-username
      	if (preg_match_all("/(^|[^@\w])@(\w{1,15})\b/u", $content, $atMentions)) {
			echo "Results \n";
			//print_r($atMentions);
			
			$possibleMentions = $atMentions[2];
			if (count($possibleMentions) > 0) {
				foreach($possibleMentions as $possibleMention) {
					//echo "P: " . $possibleMention . "\n";
					// Check database for these names
					$stmt = $pdo->prepare("SELECT User_Id FROM users WHERE User_Name = :username");
					$stmt->bindParam(":username", $possibleMention);
					$stmt->execute();
					$stmt->bindColumn("User_Id", $userid);
					$stmt->fetch();
					if ($userid != "") {
						//echo "ID:" .$userid. "\n";
						// We have a username match! All we need to do is notify them
						$from = $_SESSION["User_Name"]; // me
						$from_id = $_SESSION["User_Id"];
						//$to = $possibleMention; // this person
						//$msg = "The person @$from mentioned you in a comment.";
						$msg = "@" . $from . " 在这个评论提到了你"; // View Comments: 查看评论
						$subject = "新的评论"; // New comments
						$link = "/Article/article.php?catlogid=".$catid."#comment".$commentNumber;
						$stmt = $pdo->prepare("INSERT INTO mail SET from_user_id = :from_id, 
																	msg = :msg,
																	datetime = now(), 
																	to_user_id = :to, 
																	subject = :subject,
																	link = :link,
																	status = 'unread'");
						$stmt->bindParam(":from_id", $from_id);
						$stmt->bindParam(":msg", $msg);
						$stmt->bindParam(":to", $userid);
						$stmt->bindParam(":subject", $subject);
						$stmt->bindParam(":link", $link);
						$stmt->execute();
					}
					$userid = null; // Always reset userid for loop.
				}
			}
			      		
      	} else {
      		echo "No matches";
      	}
		

      	
            
		$pdo = null; 
		
	}	

	die();
}

?>