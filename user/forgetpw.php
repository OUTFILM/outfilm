<?php
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    session_start();    
?>
<!DOCTYPE html>
<html lang="ch">
<meta charset="UTF-8">
<title>忘记密码</title>
<link href="Login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>  

<title>QAF登录</title>
<html>
<head>
<link href="/user/register/Signup.css" rel="stylesheet" type="text/css" />	
</head>
<body>    
<?
if (isset($_POST['submit'])) {	
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	//echo "sfddddddd".$username.'s'.$email;
   
	$query_ALL = "SELECT * FROM users WHERE `E-mail` = :op_key";
	$result_t = $pdo->prepare($query_ALL);
    $result_t->bindParam(':op_key', $email, PDO::PARAM_STR); 
	$result_t->execute();
	$result_t->bindColumn('User_Name', $User_Name);
	
	if ($result_t->fetch())
	{   
		$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
		$sql = "UPDATE users SET 
        Signuphash = :hash
        WHERE `E-mail` = :op_key";
		$result_a = $pdo->prepare($sql);
		$result_a->bindParam(':op_key', $email, PDO::PARAM_STR);
		$result_a->bindParam(':hash', $hash, PDO::PARAM_STR);
		$result_a->execute(); 
		
		// Password Salt, used for locking and unlocking passwords
		$subject ="Password request/找回密码申请";
		$body = '   ------------------------
				    Username: '.$User_Name.'				    
    				------------------------
    				如果要重置密码，请点击下面链接重置密码：
    				Please click this link to reset your password:
   					http://qafone.sweetgreen.org/user/newpass.php?email='.$email.'&'.'hash='.$hash.'
    
    				如果不是本人，请不要回复或者操作任何东西，否则会追究法律责任，谢谢合作！'
					;
        $headers = 'From:noreply@http://qafone.sweetgreen.org' . "\r\n"; // Set from headers
        
		mail ($email, $subject, $body, $headers);
		echo ("邮件已经发送");
	} else {
		echo ("没有你要找的用户名或邮件，请重新尝试");
	}

}

?>
<div id="logo">QAFONE</div>
<div id="top_bar">    
    <div id="tright_bar">        
    </div>
</div>


	<form method = "POST" action = "<?=$_SERVER['PHP_SELF']; ?>">
		<p>
			<label for = "username">用户名:</label>
			<input type = "text" name = "username" />
		</p>
		<p>
			<label for = "email">邮箱:</label>
			<input type = "text" name = "email" />
		</p>
		<p>
			<input type="submit" name="submit" value="提交"/>
			<input type = "reset" name = "reset" value="清空" />
		</p>
	</form>
	
	
<div id="Footer">
    <div id="Footer_menu">
        <div class="Footer_menu_part" style="text-align: center">
            <h4 style="color: white;">合作</h4>
            <h5>关于我们</h5>
        </div>
        <div class="Footer_menu_part_line"></div>
        <div class="Footer_menu_part" style="text-align: center">
            <h4 style="color: white;">官方网站</h4>
            <a href="http://www.qafone.net/index.php"><h5>QAF中文站</h5></a>
        </div>
        <div class="Footer_menu_part_line"></div>
        <div class="Footer_menu_part"></div>
        <div class="Footer_menu_part_line"></div>
        <div id="logo1"><img src="/uploads/lo5.png"/></div>
        <div class="Footer_menu_part"></div>
        <div class="Footer_menu_part_line"></div>
        
    </div>
</div>

    
</body>
</html>