<?php
    include 'config.php';
    $topchoose = array(0 => 1, 1 => 3, 2 => 4, 3 => 2, 4 => 9);
    $Pic_Link= array();
    $Art_Headline= array();
    $Art_Datetime= array();
    $Catalog_Id = array();
	$Clicks = array();
	$Commts =  array();
	$result = array();
	
    $query_ALL = "SELECT *,count(catalog.Catalog_Id) as Commts FROM catalog LEFT OUTER JOIN comments ON catalog.Catalog_Id = comments.Catalog_Id  WHERE catalog_op LIKE :op_key GROUP BY catalog.Catalog_Id ORDER BY Datetime DESC LIMIT 2";
        $result_t = $pdo->prepare($query_ALL); 
		foreach ($topchoose as $i => $value) {  
			$result_t->bindParam(':op_key', $value, PDO::PARAM_STR);
			$result_t->execute();
	        $result_t->bindColumn('Link', $Pic_Link[$i]);
	        $result_t->bindColumn('Headline', $Art_Headline[$i]);
	        $result_t->bindColumn('Datetime', $Art_Datetime[$i]);
	        $result_t->bindColumn('Catalog_Id', $Catalog_Id[$i]);
			$result_t->bindColumn('Clicks', $Clicks[$i]);
			$result_t->bindColumn('Commts', $Commts[$i]);
	        
	        while ($result_t->fetch()) {
	            $result[] = array(
	            				"Row" => $i,
	            				"Link" => $Pic_Link[$i], 
	                            "Headline" => $Art_Headline[$i],
	                            "Clicks" => $Clicks[$i],
	                            "Commts" => $Commts[$i], 
	                            "Datetime" => $Art_Datetime[$i],
	                            "Catalog_Id" => $Catalog_Id[$i]
	                            );      
	                
	        }
			$result_t->closeCursor();
 		}
 		//print_r(array_keys($result));
        echo json_encode($result);
    

   
?>
