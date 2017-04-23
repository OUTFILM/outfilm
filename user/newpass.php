<!doctype html>
<html lang="ch">
    <head>
        <meta  charset="utf-8"/>
        <title>重置密码</title></head>
<?
   include $_SERVER["DOCUMENT_ROOT"]."/config.php";
   
   if (isset($_POST['submit'])) {
   		//echo 'ok'; 
   		$pass1 = $_POST['n_pass'];
		$pass2 = $_POST['n_2pass'];
		$match = $_POST['Userid'];
		$hash = '';
		if($pass1===$pass2) {
			$pass1 = crypt($pass1, '2a$07$laersiitanimulliehT$');
			echo $match;
	        $change_pw = "UPDATE users SET `User_Password`=:ps , Signuphash=:hash WHERE `User_Id`=:match ";
	        $stmt_n = $pdo->prepare($change_pw);
	        $stmt_n->bindParam(":match", $match, PDO::PARAM_STR);
	        $stmt_n->bindParam(":ps", $pass1, PDO::PARAM_STR);
			$stmt_n->bindParam(":hash", $hash, PDO::PARAM_STR);
	        $stmt_n->execute();
			echo "successfully  ! now go back login";
			echo "outfilm.org";
		} else {
			echo "two passwords is not the same!请刷新页面重新设置密码";
		}
   }
   
   if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
    // Verify data
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['hash']); // Set hash variable

    $search = "SELECT `User_Id` FROM users WHERE `E-mail`=:mail AND Signuphash=:hash";
    $stmt_s = $pdo->prepare($search);
    $stmt_s->bindParam(":mail", $email);
    $stmt_s->bindParam(":hash", $hash);
    $stmt_s->execute();
    $match = $stmt_s->fetchColumn(); 
        
    if($match) {
        
		?>
		<form method = "POST" action = "<?=$_SERVER['PHP_SELF']; ?>">
		<span>用户ID:<input type="text" name="Userid" value="<?=$match?>" readonly></span>
		<span>
			新密码:<input type="password" name="n_pass"/>
			再次确认:<input type="password" name="n_2pass"/>
		</span>
		<span>
			<input type="submit" name="submit" value="提交"/>
			<input type = "reset" name = "reset" value="清空" />
		</span>
		</form>
		<?
 

    } else {
        echo '<div class="statusmsg">The url is invalid.</div>';
    }

    
    }else{
    // Invalid approach
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the latest link that has been sent to your email.</div>';
}

?>


</html>