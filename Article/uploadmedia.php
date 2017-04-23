<? 
session_start(); 

if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {

if (isset($_POST["img"])) { // Process upload, but only if we're admin first

    include $_SERVER["DOCUMENT_ROOT"]."/config.php";

    // requires php5
    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/img/article');

    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
        //if the account's folder not exsist, then creat as uploads/$id/
    if (is_dir("uploads/".$_POST["cid"])) {       
        //console.log("uploads/".$_SESSION["User_Id"]."exsists!");
    } else {
        mkdir('uploads/'.$_POST["cid"], 0777, true);
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
    
}

?>
<!DOCTYPE HTML>
-
</body>
</html> 

<?
} else {
    die("Must be logged in as admin to upload.");
}
