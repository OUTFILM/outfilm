<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";
if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { 
    if (isset($_POST["article"])) { // UPDATE (save) the article
        if (!isset($_POST["aid"]) or $_POST["aid"] == null) {
            die("出了些问题。ID丢失。"); // ID is only required field.catalog_op
        }
        
        $user_id = $_SESSION["User_Id"];
        $content = trim($_POST["article"]);
        $aid = $_POST["aid"];
        $tag = trim($_POST["tag"]);
        $headline = trim($_POST["headline"]);
        $subheadline = trim($_POST["subheadline"]);   
        $is_trash = $_POST["is_trash"];
        
        
        $sql = "UPDATE catalog SET 
        Headline = :headline,
        Author = :author,
        Subheadline = :subheadline,
        Content = :content";
        $sql2 = " WHERE Catalog_Id=:aid";   
        //$link = $_POST["link"];
        if (isset($is_trash)) {
            $sql3 = " ,catalog_op = :is_trash ";
            $sql = $sql.$sql3;                
        }
        
        if (isset($tag) && !($tag == '')) {               
            $sql4 = " ,Tag = :tag ";
            $sql = $sql.$sql4;
        }
        $sql = $sql.$sql2; 
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":headline", $headline);
        $stmt->bindParam(":author", $user_id);
        $stmt->bindParam(":subheadline", $subheadline);
        $stmt->bindParam(":content", $content);
        // $stmt->bindParam(":link", $link);
        if (isset($is_trash)) {$stmt->bindParam(":is_trash", $is_trash);}
        if (isset($tag) && !($tag == '')) {$stmt->bindParam(":tag", $tag);}  
        $stmt->bindParam(":aid", $aid);
        $stmt->execute();         
        die($aid); // This id was successfully updated.
       
    }
    
    /*
    if (isset($_POST["img"])) { // Process upload, but only if we're admin first

        include $_SERVER["DOCUMENT_ROOT"]."/config.php";

        //requires php5
        define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/img/article/');

        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
            //if the account's folder not exsist, then creat as uploads/$id/
        if (is_dir(UPLOAD_DIR . $_POST["cid"])) {       
            //console.log("uploads/".$_SESSION["User_Id"]."exsists!");
        } else {
            mkdir(UPLOAD_DIR . $_POST["cid"], 0777, true);
            //console.log("uploads/".$_SESSION["User_Id"]."made a new one!"); 
        }
        $ttempis = uniqid();
        $file = UPLOAD_DIR .$_POST["cid"].'/'. $ttempis . '.png';

        $success = file_put_contents($file, $data);
        print $success ? $file : 'Unable to save the file.' . $_POST["img"];

        $mediaTitle = $_POST["title"];
        $mediaType = "image";
        $mediaExtension = "png";
        $mediaSize = filesize($file);
        $uploadUser = $_SESSION["User_Id"];
        $catalog_id = $_POST["cid"];
        $hashlink = $ttempis;
        $sql = "INSERT INTO media SET 
                        Title = :title,
                        Hashlink = :hashlink,
                        Type = :type,
                        Extension = :extension,
                        Size_Img = :size,
                        User_Id = :user_id,
                        Catalog_Id = :cid  ";

        $result_t = $pdo->prepare($sql);
        $result_t->bindParam(':title', $mediaTitle);
        $result_t->bindParam(':hashlink', $hashlink);
        $result_t->bindParam(':type', $mediaType);
        $result_t->bindParam(':extension', $mediaExtension);
        $result_t->bindParam(':size', $mediaSize);
        $result_t->bindParam(':user_id', $uploadUser);
        $result_t->bindParam(':cid', $catalog_id);
        $result_t->execute();

        die("Success");

    }*/    
        
        
    
} else {
    die("您没有权限张贴或编辑文章。请与管理员联系。"); // Deny access to those under 150
}


?>