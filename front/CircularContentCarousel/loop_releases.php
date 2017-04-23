<?php

    include 'config.php';
    
    
    $query_ALL = "SELECT * FROM releases ORDER BY Datetime DESC LIMIT 10";
        $result_t = $pdo->prepare($query_ALL);
        //$result_t->bindParam(':page_key',$page_key); 
        $result_t->execute();
        $result_t->bindColumn('ch_name', $ch_name);
        $result_t->bindColumn('en_name', $en_name);
        $result_t->bindColumn('intro', $intro);
        $result_t->bindColumn('online_link', $online_link);
        $result_t->bindColumn('down_link', $down_link);
        $result_t->bindColumn('poster_link', $poster_link);
        $result = array();
        while ($result_t->fetch()) {
            $result[] = array("ch_name" => $ch_name, 
                            "en_name" => $en_name, 
                            "intro" => $intro, 
                            "online_link" => $online_link, 
                            "down_link" => $down_link,
                            "poster_link" => $poster_link
                            );      
                
        }
        //print_r($result);
        echo json_encode($result);
    

   
?>







