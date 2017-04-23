<?php

    include '../config.php';
    //if(!is_numeric($_GET['page']))    $_GET['page'] = 1;
    $code = $_POST['id'];
    $comb_key = $_POST['comb_key'];
    $first = 1;
    $query_ALL = "SELECT `used` FROM code WHERE code = :code";
        $result_t = $pdo->prepare($query_ALL);
        $result_t->bindParam(':code',$code); 
        $result_t->execute();
        $is_used = $result_t->fetchColumn(); 
        if ($is_used) {
          echo $is_used;        
        } else {
          echo "3".$is_used;
          /*id it is not used put it in the database*/
          $query_ALL1 = "INSERT INTO code (idcode,code,used) VALUES (:idcode,:code,:used)";
            $result_t1 = $pdo->prepare($query_ALL1);
            $result_t1->bindParam(':idcode', $comb_key);
            $result_t1->bindParam(':code', $code);
            $result_t1->bindParam(':used', $first);
            $result_t1->execute();
          /*                                        */            
        }
    

   
?>
