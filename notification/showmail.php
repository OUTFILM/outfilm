<?php
session_start();
if (!isset($_SESSION["User_Id"])) die("Not logged in.");

include $_SERVER["DOCUMENT_ROOT"]."/config.php";

function deleteMsg() {
	global $pdo;
	
	$user_id = $_SESSION["User_Id"]; // Cannot read another user's mail!
	$mail_id = $_GET["mail_id"];
	
	$sql = "UPDATE mail SET status = 'deleted' WHERE to_user_id = :user_id and mail_id = :mail_id";	
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":user_id", $user_id);
	$stmt->bindParam(":mail_id", $mail_id);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
		$data = array("success" => 1); // User name and mail id matched, so we're good.
	} else {
		$data = array("success" => 0); // Cannot update a non-existing mail msg or update someone else's mail!
	}
	
	return json_encode($data);
}

function readMsg() {
	global $pdo;
	
	$user_id = $_SESSION["User_Id"]; // Cannot read another user's mail!
	$mail_id = $_GET["mail_id"];
	
	$sql = "UPDATE mail SET status = 'read' WHERE to_user_id = :user_id and mail_id = :mail_id";	
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":user_id", $user_id);
	$stmt->bindParam(":mail_id", $mail_id);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
		$data = array("success" => 1); // User name and mail id matched, so we're good.
	} else {
		$data = array("success" => 0); // Cannot update a non-existing mail msg or update someone else's mail!
	}
	
	return json_encode($data);
}

function getAllMail() {
	global $pdo;

	$user_id = $_SESSION["User_Id"];
	
	// Newest ones at top, limit to 100 shown
	$sql = "SELECT * FROM mail WHERE to_user_id = :user_id and status!='deleted' ORDER BY datetime DESC LIMIT 100"; 
	
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":user_id", $user_id);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$stmt->bindColumn("mail_id", $mail_id);
		$stmt->bindColumn("from_user_id", $from_user_id);
		$stmt->bindColumn("msg", $msg);
		$stmt->bindColumn("datetime", $datetime);		
		$stmt->bindColumn("subject", $subject);	
		$stmt->bindColumn("link", $link);
		$stmt->bindColumn("status", $status);
		$stmt->bindColumn("importance", $importance);
		$data = array();
		while ($stmt->fetch()) {
			// Get user name and portrait from who the comment is from...
			$sql = "SELECT Portrait_Id,User_Name FROM users WHERE User_Id=:user_id";
			$stmt_users = $pdo->prepare($sql);
			$stmt_users->bindParam(':user_id', $from_user_id);
			$stmt_users->execute();
			$stmt_users->bindColumn('Portrait_Id', $from_avatar);
			$stmt_users->bindColumn('User_Name', $from_user_name);
			$stmt_users->fetch();			
				
			$dt = new DateTime($datetime);
			$data[] = array(
				"from_user_id" => $from_user_id, 
				"from_user_name" => htmlentities($from_user_name, ENT_QUOTES),
				"from_avatar" => $from_avatar,
				"datetime" => $dt->format('c'),
				"msg" => preg_replace( "/\r|\n/", "", nl2br(htmlentities($msg, ENT_QUOTES))),
				"mail_id" => $mail_id,
				"subject" => htmlentities($subject, ENT_QUOTES),
				"link" => $link,
				"status" => $status,
				"importance" => $importance 						
			); 
		}	
	}

	if (empty($data)) $data = array('none'=>'1'); // Empty
	return json_encode($data); // Return only the array status/JSON pack of mail messages
}

function showMailAjax() {
?>
<!DOCTYPE HTML>
<html><head><meta charset="UTF-8"> 
<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/scripts/jquery.transit.min.js"></script>
<script type="text/javascript" src="/scripts/moment/moment-with-locales.js"></script>
<script type="text/javascript" src="/scripts/livestamp.min.js"></script>

<!--<script type="text/javascript" src="/scripts/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/scripts/jquery-ui-1.11.4/jquery-ui.min.css" />-->
<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" />

<script type="text/javascript">

$(document).ready(function () {
moment.locale('zh-cn');
getNotifications();

}); // end of doc-ready

var _mailTotal;
function getNotifications() {
	$("#showMail").empty();
	$.ajax({
		cache: false,
		url: "/notification/showmail.php",
		data: { 'showAll': '1' },
		dataType: "json",
		success: function(result) {       	
			if (result.none != 1) {
	        	var mailTotal = 0;
	        	$.each(result, function(key,value) { 		
	  	        	mailTotal++;
	        		mailPop(value.from_user_id, value.from_user_name, value.from_avatar, 
	        			    value.datetime, 	value.msg, 			  value.mail_id, 
	        			    value.subject,		value.link,		      value.status,
	        			    value.importance,	mailTotal);
				});
				$("#mailTotal").html("消息  ("+mailTotal+")"); // Update total count		
				_mailTotal = mailTotal;		
			} else {
				// No new messages
				$("#showMail").html("<p>你没有新的通知</p>");
			}		
		}
	});
}

function mailPop(from_user_id, from_user_name, from_avatar, 
				 datetime, 	   msg, 		   mail_id,
				 subject,	   link,		   status,
				 importance,   mailTotal) {
	// No need to filter mail yet; add later if user-content is added as mail messages
	//var content = filterChat(content);
	
	var msgClass = "mailmsg";
	if (status == "unread") msgClass = "mailmsg unread";   
	
	var newMail = $('<div class="msgContainer">' +
		'<div class="' + msgClass + '" onclick="readMsg('+mail_id+', \''+link+'\', \''+status+'\')"><img class="msg_avatar" src="/uimg/'+from_user_id+'/'+from_avatar+'.png" />' +
		'<div class="msg_white"><p><span style="color: #999; font-weight: bold;">' + subject + '<span>' +
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;"> <span data-livestamp="'+datetime+'"></span>' + 
		'</p>' +
		'<p style="font-weight: normal;">'+msg+'</p></div></div> <div class="deleteMsg silk-icon-cross" onclick="deleteMsg('+mail_id+')"></div>  </div> '); 

	$("#showMail")		
		.append(newMail.css("opacity", 0))
		.animate(
			{ scrollTop: $('#showMail')[0].scrollHeight }, 
			5, 
			function() {
				newMail.transition({ y: '-15px', 'opacity': 1, 'easing': 'in' }, 500);	
			}
		);			
}

function readMsg(mail_id, link, status) {
	//console.log(mail_id);
	// Mark as read in database
	
	if (status == "unread") {
		$.ajax({
			cache: false,
			url: "/notification/showmail.php",
			data: { 
				'readMsg' : '1', 
				'mail_id' : mail_id 
			},
			dataType: "json",
			success: function(result) {       	
				if (result.success == 1) {
		        	// Redirect user to specified link		        	        		        	
				} else {
					// Couldn't mark as read -- Oh well. 
				}		
				window.location.replace(link);	
			}
		});	
	} else {
		window.location.replace(link);	
	}
}

function deleteMsg(mail_id) {
	$.ajax({
		cache: false,
		url: "/notification/showmail.php",
		data: { 
			'deleteMsg' : '1', 
			'mail_id' : mail_id 
		},
		dataType: "json",
		success: function(result) {       	
			if (result.success == 1) {
	        	// Show results again     	        		        	
			} else {
				// Couldn't delete -- Oh well. 
			}		
			getNotifications();		
		}
	});	
}

</script>

<style>
@font-face {
    font-family: 'PingFang-Regular';
    src: url('/scripts/pingfang/PingFangReg.eot');
    src: url('m/scripts/pingfang/PingFangReg.eot?#iefix') format('embedded-opentype'),
    url('/scripts/pingfang/PingFangReg.svg#PingFang-Regular') format('svg'),
    url('/scripts/pingfang/PingFangReg.woff') format('woff'),
    url('/scripts/pingfang/PingFangReg.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

body {
	font-family: 'PingFang-Regular';
}

.deleteMsg {
	float: left;
	height: 18px;
	width: 18px;
	margin: 4px;
	position: absolute;
	right:0px;
	top:0px;
}
.deleteMsg:hover {
	cursor: pointer;
}
.msgContainer {
    min-height: 70px;
    min-width: 750px;
    float: left;
    border-bottom: 1px solid #cccccc;
}
.mailmsg {
	
	padding: 0.5em 0 0.25em 0;
	clear: both;
	min-height: 60px;
	min-width: 700px;
	float: left;
}

.mailmsg:hover {
	cursor: pointer;
}

.msg_avatar {
	width: 52px;
	float: left;
	padding-right: 1em;
}

.mailmsg p {
	margin: 0;
}

.unread {
	background-color: rgba(21, 91, 136, 0.8);
	color: #ffffff;
}

</style>

</head>

<body>
<div>
	<h3 id="mailTotal"></h3>
</div>
<div id="showMail"style="float:left;margin-top: 20px;">
		
</div>
</body>
</html>
<?
}


// Main driver of this notifications viewing
if ($_GET["showAll"]) {
	die(getAllMail()); // Show all mail in JSON array (via AJAX only);
} elseif($_GET["readMsg"]) {
	die(readMsg());
} elseif($_GET["deleteMsg"]) {
	die(deleteMsg());
} else {
	showMailAjax();
}


?>