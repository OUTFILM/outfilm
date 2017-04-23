<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";


if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
			
		$query_dete = "DELETE FROM spotlight WHERE `catalogid`=:catalogid;";			
        $cat_i = $_POST["spot_id"];        
        $result_dete = $pdo->prepare($query_dete);
        $result_dete->bindParam(':catalogid', $cat_i);
        $result_dete->execute();
        echo "200";
} 

else {
    die("您没有权限张贴或编辑文章。请与管理员联系。"); // Deny access to those under 150
}?>