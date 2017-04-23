<?php

session_start();

if (isset($_SESSION["User_Id"]) and isset($_GET["aid"])) {
	include $_SERVER["DOCUMENT_ROOT"]."/config.php";
	
	$aid = $_GET["aid"];
	
	$sql = "SELECT DISTINCT user_id FROM donations WHERE article_id=:article_id AND status='Verified' ";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":article_id", $aid);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$stmt->bindColumn("user_id", $user_id);
		$data = array();
		while($stmt->fetch()) { // Build JSON array 
			$sql = "SELECT Portrait_Id,User_Name FROM users WHERE User_Id=:user_id";
			$stmt_users = $pdo->prepare($sql);
			$stmt_users->bindParam(':user_id', $user_id);
			$stmt_users->execute();
			$stmt_users->bindColumn('Portrait_Id', $avatar);
			$stmt_users->bindColumn('User_Name', $user_name);
			$stmt_users->fetch();
			
			$data[] = array(
				"user_id" => $user_id,
				"user_name" => htmlentities($user_name, ENT_QUOTES),
				"avatar" => $avatar
			);
			
		}
	}
	$pdo = null;	
	
	if (empty($data)) $data = array("status" => "0");
	die(json_encode($data));	
}


?>