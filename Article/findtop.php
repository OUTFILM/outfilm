<?php

session_start();
include $_SERVER["DOCUMENT_ROOT"]."/config.php";

    
    $query_ALL = "SELECT * FROM catalog ORDER BY Clicks DESC LIMIT 4";
        $result_t = $pdo->prepare($query_ALL);
        //$result_t->bindParam(':page_key',$page_key); 
        $result_t->execute();
        $result_t->bindColumn('Link', $Pic_Link);
        $result_t->bindColumn('Tag', $Art_Tag);
        $result_t->bindColumn('Headline', $Art_Headline);
        $result_t->bindColumn('Catalog_Id', $Catalog_Id);
        $result = array();
        while ($result_t->fetch()) {
            $result[] = array("Link" => $Pic_Link, 
                            "Tag" => $Art_Tag, 
                            "Headline" => $Art_Headline, 
                            "Catalog_Id" => $Catalog_Id
                            );      
                
        }
        //print_r($result);
        echo json_encode($result);
    

   
?>
