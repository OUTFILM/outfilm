<?php
   include $_SERVER['DOCUMENT_ROOT']."/config.php";
    //session_start();
    
    $tep = '/';
	$ch_name = $_POST['ch_name'];
    $en_name = $_POST['en_name'];
    $temppath = $tep.$_POST['temppath'];
	/*
    $year1 = $_POST['year'];
    $time1 = $_POST['time'];
    $region1 = $_POST['region'];
    $intro = $_POST['intro'];
    $a_link = $_POST['a_link'];
    $d_link = $_POST['d_link'];
    
    $option1 = $_POST['option'];*/
	$catalog_id = $_POST['catalog_id'];
    
    $into = 0;
    $isshow = 1;
    $query_ALL = "INSERT INTO releases (en_name,ch_name,poster_link,Datetime,catalog_id,isshow) VALUES (:en_name,:ch_name,:temppath,:Now,:catalog_id,:isshow)";
    $result_t = $pdo->prepare($query_ALL);
        $result_t->bindParam(':en_name', $en_name);
        $result_t->bindParam(':ch_name', $ch_name);
		/*
        $result_t->bindParam(':year', $year1);
        $result_t->bindParam(':time', $time1);
        $result_t->bindParam(':intro', $intro);
        $result_t->bindParam(':region', $region1);
        $result_t->bindParam(':option', $option1);
        $result_t->bindParam(':a_link', $a_link);
		 * $result_t->bindParam(':status', $into); 
        $result_t->bindParam(':d_link', $d_link);*/
        $result_t->bindParam(':temppath', $temppath);     
        $result_t->bindParam(':Now', date("Y-m-d H:i:s"));
		$result_t->bindParam(':catalog_id', $catalog_id);
		$result_t->bindParam(':isshow', $isshow);     
        $result_t->execute();

?>