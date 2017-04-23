<html>
    <head>
        <meta content="UTF-8" />
        <title>激活账号</title></head>
<?
   include $_SERVER["DOCUMENT_ROOT"]."/config.php";
   if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
    $Verified = '0';
    $Verified1 = '1';
    $search = "SELECT `User_Id` FROM users WHERE `E-mail`=:mail AND Signuphash=:hash AND Verified=:Verified";
    $stmt_s = $pdo->prepare($search);
    $stmt_s->bindParam(":mail", $email);
    $stmt_s->bindParam(":hash", $hash);
    $stmt_s->bindParam(":Verified", $Verified);
    $stmt_s->execute();
    $match = $stmt_s->fetchColumn(); 
        
    if($match) {
        
        $change_status = "UPDATE users SET `Verified`=:Verified1 WHERE `User_Id`=:match ";
        $stmt_u = $pdo->prepare($change_status);
        $stmt_u->bindParam(":match", $match);
        $stmt_u->bindParam(":Verified1", $Verified1);
        $stmt_u->execute();
        ?><a href="http://qafone.sweetgreen.org/user/login.php"><?    
        echo "successfully activiated ! now go back login";?></a><?

    } else {
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }

    
    }else{
    // Invalid approach
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
}

?>


</html>