<?php
	session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
	//if(!is_numeric($_GET['page']))	$_GET['page'] = 1;
	
	$id_key = $_GET['aid'];
	//$id_key = 1234;	
	
	//$query_ALL = "SELECT `Tag` FROM catalog WHERE Catalog_Id = $id_key";
	$query_ALL = "SELECT `Content` FROM `catalog` WHERE `Catalog_Id` = :id_key";
	$result_t = $pdo->prepare($query_ALL);
	$result_t->bindParam(':id_key',$id_key); 
    //$result_t->bindColumn('Tag', $Art_Content);
	$result_t->execute();
	$num = $result_t->fetchColumn(); 

 	echo $num;
 	//print_r($result_t);
   
?>
