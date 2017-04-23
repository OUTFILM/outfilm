<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";
$isshow = 0;

if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
		$query_dete = "UPDATE releases SET `isshow`='0' WHERE `catalog_id`=:catalogid ";
        $cat_i = $_POST["release_id"];        
        $result_dete = $pdo->prepare($query_dete);
        $result_dete->bindParam(':catalogid', $cat_i);
        $result_dete->execute();
        echo "200";
}  

else {
    die("您没有权限张贴或编辑文章。请与管理员联系。"); // Deny access to those under 150
}?>