<?php

session_start();
include "../config.php";

$query_ALL = "SELECT `Portrait_Id` FROM `users` WHERE `User_Id` = :id_key";
$result_t = $pdo->prepare($query_ALL);
$result_t->bindParam(':id_key',$_SESSION["User_Id"]); 
$result_t->execute();
$num = $result_t->fetchColumn(); 

echo "/uimg/".$_SESSION["User_Id"].'/'.$num.'.png';
   
?>