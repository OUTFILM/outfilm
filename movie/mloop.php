<?php
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    //if(!is_numeric($_GET['page']))    $_GET['page'] = 1;
    $page_key = ($_GET['page']-1)*8;

    

    $query_NUM = "SELECT COUNT(idmovie) FROM movie";
    if($result_n = $pdo->prepare($query_NUM)) {
        $result_n->execute();
        $number_of_rows = $result_n->fetchColumn(); 
        /*echo "$number_of_rows";*/
    } else {
        die();
    }
    
    $query_ALL = "SELECT * FROM movie ORDER BY Datetime DESC LIMIT 8 OFFSET $page_key";
        $result_t = $pdo->prepare($query_ALL);
        //$result_t->bindParam(':page_key',$page_key); 
        $result_t->execute();
        $result_t->bindColumn('movielink', $link);
        $result_t->bindColumn('moviepic', $mpic);
        $result_t->bindColumn('view', $mview);
        $result_t->bindColumn('idmovie', $mid);
        $result = array();
        while ($result_t->fetch()) {
            $result[] = array("movielink" => $link, 
                            "moviepic" => $mpic, 
                            "view" => $mview,
                            "mid" => $mid
                            );      
                
        }
        $result[] = array("Count" => $number_of_rows);
        //print_r($result);
        echo json_encode($result);
    

   
?>
