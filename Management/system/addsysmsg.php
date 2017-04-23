<?php
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
session_start(); 

if(isset($_SESSION["User_Id"])) {
	if($_SESSION["myrank"]>=150) {   	
	    $click_url = $_POST['click_url'];
	    $notification = $_POST['notification'];
	    $author =$_POST['author'];   
		
	    $query_ALL = "INSERT INTO Notification (author,datatime,content,link) VALUES (:author,:Now,:notification,:click_url)";
	    $result_t = $pdo->prepare($query_ALL);
	        $result_t->bindParam(':author', $author);  
	        $result_t->bindParam(':Now', date("Y-m-d H:i:s"));
			$result_t->bindParam(':notification', $notification);
			$result_t->bindParam(':click_url', $click_url);     
	        $result_t->execute();
		
	} else { die("illeagle passing!");}
}
else {
	die('Visitor ia not allowed');
}
?>