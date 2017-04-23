<?php 
    session_start();
    $username = $_SESSION["User_Name"];
    $_SESSION = array();
	/*
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(),"",time()-42000,'/');
    }
	 */
    session_destroy();
?>
<html>
    <head><title>退出系统</title></head>
    <p>byebye</p>
    <a href="http://qafone.sweetgreen.org/">login again</a>
</html>