<?php
   include $_SERVER['DOCUMENT_ROOT']."/config.php";
    session_start();
    
    $tep = '/';
    $kmovie_name = $_POST['headline1'];
    $pic = $tep.$_POST['pic'];
    $tag = $_POST['tag1'];
    $mlink = $_POST['art_link1'];
    $into = 0;
    
    $query_ALL = "INSERT INTO movie(movielink,moviepic,tag,Datetime,view,moviename) VALUES (:movielink,:moviepic,:tag,:Now,:view,:moviename)";
    $result_t = $pdo->prepare($query_ALL);
        $result_t->bindParam(':movielink', $mlink);
        $result_t->bindParam(':moviepic', $pic);
        $result_t->bindParam(':tag', $tag);   
        $result_t->bindParam(':Now', date("Y-m-d H:i:s"));
        $result_t->bindParam(':view', $into);
        $result_t->bindParam(':moviename', $kmovie_name);
        $result_t->execute();

?>