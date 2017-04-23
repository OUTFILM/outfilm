<?php
// Used only for adding an (unverified) donation to the database
//  Donations Table:
//  Account_Name, Claimed Amount, Verified_Amount, Timestamp, Method, 
//	Article_Id, User_Id, Is_Anonymous, 
//   Status (Unverified by default) StatusChangeDatetime

session_start();

if (isset($_SESSION["User_Id"]) and isset($_POST["donate"])) {

	$account_name = $_POST["account_name"];
	$claimed_amount = $_POST["amount"];
	$article_id = $_POST["article_id"];
	$is_anonymous = 0; //$_POST["is_anonymous"];
	$user_id = $_SESSION["User_Id"];
	$method = "Tenpay"; // Or alipay?
	$status = "Unverified";
	
	if ($claimed_amount < 1) {
		$response = array("error" => "不能捐小于  ¥1");
	}
	
	if ($account_name == "" or $account_name == null 
		or mb_strlen($account_name, "UTF-8") <= 1) {
		$response = array("error" => "帐户登录不能为空");
	}
	
	if (!$response) {	
		include $_SERVER["DOCUMENT_ROOT"]."/config.php";	
		
		$sql = "INSERT INTO donations SET
						account_name = :account_name,
						claimed_amount = :claimed_amount,
						article_id = :article_id,
						is_anonymous = :is_anonymous,
						user_id = :user_id,
						method = :method,
						status = :status,
						date_submitted = now()	";
		$result = $pdo->prepare($sql);
		$result->bindParam(":account_name", $account_name);
		$result->bindParam(":claimed_amount", $claimed_amount);
		$result->bindParam(":article_id", $article_id);
		$result->bindParam(":is_anonymous", $is_anonymous);
		$result->bindParam(":user_id", $user_id);
		$result->bindParam(":method", $method);
		$result->bindParam(":status", $status);
		$result->execute();
		
		$id = $pdo->lastInsertId();
		
		// Generate link to window.open for user
		$link = "https://www.tenpay.com/v2/account/pay/paymore_cft.shtml";
		$qq = "6040408";
		$validate = md5($id);
		$fullLink = $link."?data=".$qq."%26".$claimed_amount."%26".$id."&validate=".$validate;
		$response = array("redirect" => $fullLink, "error" => "0");	
	}
} else {
	$response = array("error" => "E: " . $_POST["donate"]); // Other error -- not logged in. Be mysterious.
}

die(json_encode($response));

?>