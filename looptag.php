<?php
    include 'config.php';
    //if(!is_numeric($_GET['page']))    $_GET['page'] = 1;
    $page_key = ($_GET['page']-1)*6;
/*
    $query_NUM = "SELECT COUNT(Catalog_Id) FROM catalog";
    if($result_n = $pdo->prepare($query_NUM)) {
        $result_n->execute();
        $number_of_rows = $result_n->fetchColumn(); 
        /*echo "$number_of_rows";
    } else {
        die();
    }
	*/
	$keyword = $_GET['key'];
    $stag = $_GET['s_tag'];
    if ($stag != "") {        
        $query_ALL = "SELECT *,count(catalog.Catalog_Id) as Commts FROM catalog LEFT OUTER JOIN comments ON catalog.Catalog_Id = comments.Catalog_Id WHERE catalog_op LIKE 1 AND Tag LIKE '%$stag%' GROUP BY catalog.Catalog_Id ORDER BY Datetime DESC LIMIT 6 OFFSET $page_key";
    } else {
        $query_ALL = "SELECT *,count(catalog.Catalog_Id) as Commts FROM catalog LEFT OUTER JOIN comments ON catalog.Catalog_Id = comments.Catalog_Id WHERE catalog_op LIKE 1 GROUP BY catalog.Catalog_Id ORDER BY Datetime DESC LIMIT 6 OFFSET $page_key";   
    }
	
	if (isset($keyword)) $query_ALL = "SELECT *,count(catalog.Catalog_Id) as Commts FROM catalog LEFT OUTER JOIN comments ON catalog.Catalog_Id = comments.Catalog_Id WHERE catalog_op LIKE 1 AND Headline LIKE '%$keyword%' GROUP BY catalog.Catalog_Id ORDER BY Datetime DESC LIMIT 6 OFFSET $page_key"; 

        $result_t = $pdo->prepare($query_ALL);
        //$result_t->bindParam(':page_key',$page_key);
        //$result_t1->bindParam(':p_key', $page_key, PDO::PARAM_STR);
        $result_t->execute();
        //if(isset($_GET['s_tag'])) $result_t->bindParam(':p_key', $stag, PDO::PARAM_STR);
        $result_t->bindColumn('Link', $Pic_Link);
        $result_t->bindColumn('Tag', $Art_Tag);
        $result_t->bindColumn('Headline', $Art_Headline);
        $result_t->bindColumn('Content', $Art_Content);
        $result_t->bindColumn('Datetime', $Art_Datetime);
        $result_t->bindColumn('Catalog_Id', $Catalog_Id);
        $result_t->bindColumn('Clicks', $clicks);
        $result_t->bindColumn('Commts', $Commts);
        $result = array();
        $countRows = 0;
        while ($result_t->fetch()) {
        	$countRows++;
            $result[] = array("Link" => $Pic_Link, 
                            "Tag" => $Art_Tag, 
                            "Headline" => $Art_Headline, 
                            "Content" => $Art_Content, 
                            "Datetime" => $Art_Datetime,
                            "Catalog_Id" => $Catalog_Id,
                            "Number" => $countRows,
                            "Clicks" => $clicks,
                            "Commts" => $Commts
                            );      
                
        }
        //$result[] = array("CountRows" => $number_of_rows);
        //print_r($result);
        echo json_encode($result);
    

   
?>
