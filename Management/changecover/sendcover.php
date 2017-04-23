<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";
if(isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
    
    $tep = '/';
    $cataid = intval($_POST['cataid']);
    $link = $tep.trim($_SESSION['tem_path_cc'], " ");
    
    
 
     
        $sql = "UPDATE catalog SET Link = :Link WHERE Catalog_Id = :cataid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":Link", $link);
        $stmt->bindParam(":cataid", $cataid);
        $stmt->execute();      
    	$_SESSION['tem_path_cc'] = '';
} else die("no access");

?>
