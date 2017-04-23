<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";
if(isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
    
    $tep = '/';
    $spothead = $_POST['spothead'];
    $cataid = $_POST['cataid'];
    $link = $tep.trim($_SESSION['tem_path'], " ");

    
 
     
    
    $query_ALL = "INSERT INTO spotlight (catalogid,time,newheadline,pic_path) VALUES (:cataid,:Now,:spothead,:link)";
    $result_t = $pdo->prepare($query_ALL);
        $result_t->bindParam(':spothead', $spothead);
        $result_t->bindParam(':cataid', $cataid);
        $result_t->bindParam(':link', $link);
        $result_t->bindParam(':Now', date("Y-m-d H:i:s"));
        $result_t->execute();
    
} else die("no access");

?>
