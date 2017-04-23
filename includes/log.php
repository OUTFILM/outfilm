<?php 
/*
 * Visitor log update, or new record. Do after sign in, to get user_id. - Doug Lee 15-1108 Updated 15-1224
 */ 

if (session_id() == '' || !isset($_SESSION)) session_start(); // Create session if not already started from user.
if (!isset($pdo)) include $_SERVER["DOCUMENT_ROOT"]."/config.php";	// DB PDO config only

$_SESSION["redirectAfterLogin"] = $_SERVER['REQUEST_URI']; // Always store current page, in case we're logging in

if (isset($_SESSION["visitor_id"])) { // visitor ID exists; track the page they are currently on.
	$date_and_page = date("Y-m-d H:i:s") . " " . $_SERVER['REQUEST_URI'];
	$sql = "UPDATE visitors SET 
		page_history = concat_ws(char(10 using utf8), page_history, :current_page_uri), 
		last_seen = now(), total_page_views = (total_page_views + 1)
		WHERE visitor_id=:visitor_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":current_page_uri", $date_and_page);
	$stmt->bindParam(":visitor_id",  $_SESSION["visitor_id"], PDO::PARAM_INT); 
	$stmt->execute();
    
	//die("V:".  $_SESSION["visitor_id"]);
	// We can exit this script now; we are done tracking.
} else {

	if (isset($_SESSION["User_Id"])) {
		$current_user_id = $_SESSION["User_Id"]; 
	} else {
		$current_user_id = "";
	}
	
	// Check IP against database
	$stmt = $pdo->prepare("SELECT ip,host,visitor_id,user_id_link FROM visitors WHERE ip=INET_ATON(:ip)"); // ip is an indexed column; not sure if it adds performance
	$stmt->bindParam(':ip', $_SERVER["REMOTE_ADDR"]);
	$stmt->execute();
	if ($stmt->rowCount() > 0) { 
		//$visitor_id = $stmt->fetchColumn("visitor_id");
		$stmt->bindColumn('visitor_id', $visitor_id);
		//$stmt->bindColumn('user_id_link', $_SESSION["visitor_user_id_link"]);
		$stmt->bindColumn('host', $_SESSION["visitor_host"] );
		$stmt->fetch();
		
		// Check if the user is banned; immediately redirect to banned page if so
		$stmt = $pdo->prepare("SELECT visitor_id,status FROM visitors WHERE visitor_id=:visitor_id AND status='blocked'");
		$stmt->bindParam(":visitor_id", $visitor_id, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->rowCount() > 0) { // This IP is banned/blocked; use header:location to redirect away
			$_SESSION["blocked"] = true;
			echo "您的IP地址显示被封锁。如果您认为这是错误，请与网站的管理员。"; // "You are blocked."
			exit;
		}
		
		// Yay, a return customer! Update the visitor log. 
		$sql = "UPDATE visitors SET last_seen=now(), total_visits=(total_visits+1), host=:host WHERE visitor_id=:visitor_id";
		$stmt = $pdo->prepare($sql);
		//$stmt->bindParam(":user_id", $current_user_id);
		if ("" == $_SESSION["visitor_host"]) $_SESSION["visitor_host"] = gethostbyaddr($_SERVER["REMOTE_ADDR"]); // Couldn't get host last time for some reason.	
		$stmt->bindParam(":visitor_id", $visitor_id, PDO::PARAM_INT);
		$stmt->bindParam(":host", $_SESSION["visitor_host"]);
		$stmt->execute();  
		$_SESSION["visitor_id"] = $visitor_id; // Look for this id in the next loading of this script
	} else { // Completely new customer, never seen before until now
		// Determine the visitor type, and get hostname
		$_SESSION["visitor_host"] = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
	
		if (preg_match("/(bot|spider|search|crawl|google|yahoo|bing|baidu)+/", $_SESSION["visitor_host"])) {
			$visitor_type = "机器人"; // Bot
		} else {
			$visitor_type = "人";
		}
	
		$sql = "INSERT INTO visitors SET ip=INET_ATON(:ip), host=:host, first_seen=now(), total_visits=1, total_page_views=1, visitor_type=:visitor_type";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":ip", $_SERVER["REMOTE_ADDR"]);
		$stmt->bindParam(":host", $_SESSION["visitor_host"]);
		$stmt->bindParam(":visitor_type", $visitor_type);
		$stmt->execute();
		$_SESSION["visitor_id"] = $pdo->lastInsertId();
        
	}
}

// track hits, for articles and such (so far, just internal articles here)
// Note: each new session resets the tracking capability (seems fair and is less db intensive, kind of.)
if (isset($_GET["catlogid"])) {
    $catid = $_GET["catlogid"];
    
    if (!isset($_SESSION["articles_log"])) $_SESSION["articles_log"] = array();
    
    // find the catlogid in the articles log
    if (!in_array($catid, $_SESSION["articles_log"])) {        
        // it wasn't found, thus update the article with a new "hit"
        $stmt = $pdo->prepare("UPDATE catalog SET Clicks = Clicks + 1 WHERE Catalog_Id = :catid");
        $stmt->bindParam(":catid", $catid);
        $stmt->execute();
        
        $_SESSION["articles_log"][] = $_GET["catlogid"]; // Acts as a "visit" or "hit"
    }    
    
    //print_r ($_SESSION["articles_log"]);
} 

?> 