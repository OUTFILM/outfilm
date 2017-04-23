<?php
    include 'config.php';
	$result = array();
    $query_ALL = "SELECT * FROM Notification ORDER BY datatime DESC LIMIT 5";
        $result_t = $pdo->prepare($query_ALL);  
		$result_t->execute();
        $result_t->bindColumn('content', $content);
        $result_t->bindColumn('author', $author);
        $result_t->bindColumn('link', $link);
        
        while ($result_t->fetch()) {
            $result[] = array(
            				"content" => $content, 
                            "author" => $author, 
                            "link" => $link
                            );      
                
        }
		$result_t->closeCursor();
		//print_r(array_keys($result));
    	echo json_encode($result);
    
   
?>
